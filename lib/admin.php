<?php // --------- admin.php -----------------------------------------------
function yLogin($u, $p, $loginType){
	global $user; global $pass; 
	if(isset($_POST['user'])&& isset($_POST['pass'])&& isset($_SESSION['ver']) ) {
		if($_POST['user'] != NULL && $_POST['pass'] != NULL && $_SESSION['ver'] != NULL ) {
			$user = test_input($_POST['user']); $pass = test_input($_POST['pass']); 
			$ver  = test_input($_POST['ver']);
			if ($ver == $_SESSION['ver'] && password_verify($user, $u) && password_verify($pass, $p)) {
				$_SESSION['user'] = $user; $_SESSION['pass'] = $pass; 
				$action = isset($_POST['action']) ? $_POST['action'] : null;
				switch($action){
					case 'setupSite': ySetup();   break;
					case 'EditPage' : yEdit();    break;
					case 'refresh'  : yRefresh(); break;
					case 'logout'   : yLogout();	return(false);
					default:
				}
				return(true);
			}
		} 
	} else if (isset($_POST['newUser']) && isset($_POST['newPass']) ){ 
		if($_POST['newUser'] != NULL && $_POST['newPass'] != NULL ) {
			$user = test_input($_POST['newUser']); $pass = test_input($_POST['newPass']);
			$opt = ['cost' => 8,];
			yFileWrite('pwd/user.txt', password_hash($user, PASSWORD_BCRYPT, $opt));
			yFileWrite('pwd/pass.txt', password_hash($pass, PASSWORD_BCRYPT, $opt));
			return(false);
		}
	} else {
		$s = rand(10000,99999);
		$_SESSION["ver"] = $s; 
//		$_SESSION["login_attempts"] += 1;
//		if ($_SESSION["login_attempts"] >3) $_SESSION["locked"] = 'locked';
?>		<h3 class="center"><?php echo $loginType; ?> Username and Password</h3>
		<table style="width:300px;margin:12px auto" class="center">
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
<?php if ($loginType != 'New'){ ?>
			<tr><td><p>Username:  </p></td><td><input type="text" name="user"></td></tr>
			<tr><td><p>Password:  </p></td><td><input type="text" name="pass"></td></tr>
<?php }
		if ($loginType != 'Administrator'){ ?>
			<tr><td><p>New Username:  </p></td><td><input type="text" name="newUser"></td></tr>
			<tr><td><p>New Password:  </p></td><td><input type="text" name="newPass"></td></tr>
<?php }
		yCaptcha($s); ?>
			<tr><td><p>&nbsp; </p></td><td><input type="submit" value="<?php echo $loginType; ?> Login"></td></tr>
		</form> </table>
<?php 
	}
}
function yLock(){
	$difference = time() - $_SESSION["locked"];
	if ($difference > 30){
		unset($_SESSION["locked"]);
		unset($_SESSION["login_attempts"]);
	}
	if ($_SESSION["login_attempts"] > 2){
		$_SESSION["locked"] = time();
		echo "<p>Please wait for 30 seconds.</p>";
	}
}
function yCaptcha($s){
	$i = imagecreate(65, 25); //w, h
	$bg = imagecolorallocate($i, 0, 200, 200);
	$fg = imagecolorallocate($i, 255, 255, 255);
	imagestring($i, 14, 5, 5, $s, $fg);
	ob_start();
	imagejpeg($i, NULL, 80);
	$raw = ob_get_clean();	
		?><tr>
			<td></td>
			<td>
				<label class="checkbox-inline">Captcha Code</label>
				<img style="display:block;margin:8px auto;width:128px;height:48px" src="data:image/jpeg;base64,<?php echo base64_encode( $raw);?>"/>
			</td>
		</tr><tr>
			<td><p>Verify Code</p></td>
			<td><input type="text" name="ver" placeholder="Enter Captcha Code"></td>
		</tr><?php
}
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
function yLogout(){
	session_unset();
	session_destroy();
	header('Location: '.$_SERVER['REQUEST_URI']);
}
function yRefresh(){
	$d = array_filter(glob($p.'*'), 'is_dir');
	foreach (glob($p."*.gz") as $f){
		unlink($f);
		echo "Deleting ". $f ."...<br>\n";
	}
	
	$crawled = array();
	yCrawlSite(SITEURL, $crawled, 100, true);
	$crawled[count($crawled)] = SITEURL;
	$s = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
	$s .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
	$t =  date('Y-m-d', time() );
	foreach($crawled as $x){
		$s .= "\n<url>\n<loc>". $x. "</loc>\n<lastmod>".$t."</lastmod>\n</url>\n";
	}
	$s .= "</urlset>\n";
	$f = fopen(SITE_ROOT.'sitemap.xml', 'w');
	fwrite($f, $s);
	fclose($f);
}
function yCrawlSite($url, &$crawled, $depth, $delFiles){
	if($delFiles) yDelFiles(SITE_ROOT, '*.gz');
	if ($depth == 0) return ($crawled);
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_ENCODING , "");
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	$p = curl_exec ($ch);
	curl_close ($ch);
	$a = array();
	if($p){
		preg_match_all('/href=["\']?([^"\'>]+)["\']?/is', $p, $a); 
		//print_r($crawled);
		if ($a[0][0] !== ""){
			if($depth > 0){
				foreach($a[1] as $x){
					$u = trim($x);
					if (in_array($u, $crawled)) continue;
					if (stripos($u, SITEURL)===0 
							&& pathinfo($u, PATHINFO_EXTENSION)=='php') {
						echo "Processing ". $u ."<br>\n";
						$i = count($crawled);
						$crawled[$i] = $u;
						$depth --;
						yCrawlSite($u, $crawled, $depth, false);
					}
				} 
			} else { 
				echo "NOTICE: Maximum depth reached <br>\n";  return($crawled); }
		}
	} else { echo "NOTICE: couid not open ". $url ."<br>\n"; return($crawled);}
}
function yDelFiles($path, $match){// deletes all files matching $match
	$files = glob($path.$match);
	foreach($files as $f){
		if(is_file($f)){
			unlink($f);
			echo "Deleted ". $f ."...<br>\n";
		}
	}
	$dirs = glob($path."*");
	foreach($dirs as $d){
		if(is_dir($d)){
			$d = basename($d) . "/";
			yDelFiles($path.$d, $match);
		}
	}
}
function ySetup(){
}
function yEdit(){
}
