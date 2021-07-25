<?php /*//----------------------------------------------------//*/
//login.php -- to access admin.php
	$TITLE 		= "yBlog Administration";	//default=SITE_DESC
	$DESC			= "";	//default=SITE_DESC
	$AVATAR		= "";	//default=SITE_LOGO
	$MENU_ORDER	= 8;					 	//default=1,0 = not menued
//	$AUTHOR		= "Author";			 	//default=SITE_AUTHOR
	$PAGE_TYPE	= "Website";			//Article (default), Blog, Website
//	$STYLES		= "elegant");			//blue(default), none, box, elegant
//	$SCRIPT		= "js";					//default=js
//	$STYLESHEET = "var1";				//default=var1
//	$ANIMATE		= false;					//default=true
//	$ANALYTICS	= false; 				//default=true
	$CODEVIEWER = true; 					//default=false
	$ADOBE_ON	= true;					//default=false
include_once 'yBlog.php';

//--------------------------------------------------------------
	function yLogout(){
		session_destroy();
		header('Location: '.$_SERVER['REQUEST_URI']);
	}
	function yLoginCreate($u, $p, $f){
		if (isset($_POST['newUser']) && isset($_POST['newPass']) && $f == true){ 
			$opt = ['cost' => 8,];
			yFileWrite('pwd/user.txt', 
				password_hash($_POST['newUser'], PASSWORD_BCRYPT, $opt));
			yFileWrite('pwd/pass.txt', 
				password_hash($_POST['newPass'], PASSWORD_BCRYPT, $opt));
			yLoginShow($u, $p);
		} else {
			$s = rand(10000,99999); 
			$_SESSION["ver"] = $s; 
			?>
			<h3 class="center"><?php echo ($f ==true)? 'Create' : 'Change';?> Username and Password</h3>
			<table style="width:300px;margin:12px auto" class="center">
			<form action="lib/admin.php" method="post">
				<tr>
					<td><p>Create Username:  </p></td>
					<td><input type="text" name="newUser"></td>
				</tr><tr>
					<td><p>Create Password:  </p></td>
					<td><input type="text" name="newPass"></td>
				</tr><?php yCaptcha($s); 
				?><tr>
					<td><p>&nbsp;     </p></td>
					<td><input type="submit" value="Go"></td>
				</tr>
			</form>
			</table>
			<br>
			<p>&nbsp;</p>
			<blockquote><b>IMPORTANT</b>: You will not have a chance to change these until after 
			you login with them!</blockquote>
			<?php
		}
	}
	function yLoginShow($u, $p){
		debug();
		$user	= "";
		$pass	= "";
		if(isset($_SESSION['user'])&& isset($_SESSION['pass'])) {
			$user = $_SESSION["user"]; 
			$pass = $_SESSION['pass'];
			if (password_verify($user, $u) && password_verify($pass, $p)) {
				yAdmin(); 
			} 
		}else if(isset($_POST['user'])&& isset($_POST['pass'])&& isset($_POST['ver'])) {
			if ($_POST["ver"] == $_SESSION["ver"]){
				$user = $_POST['user'];
				$pass = $_POST["pass"]; 
				if (password_verify($user, $u) && password_verify($pass, $p)) {
					$_SESSION["user"] = $user; 
					$_SESSION["pass"] = $pass; 
					yAdmin();
				} 
			}
		}else {
			$s = rand(10000,99999); 
			$_SESSION["ver"] = $s; 
			?>
			<h3 class="center">Owner Login</h3>
			<table style="width:300px;margin:12px auto" class="center">
			<form action="lib/admin.php" method="post">
				<tr>
					<td><p>Username:  </p></td>
					<td><input type="text" name="user"></td>
				</tr><tr>
					<td><p>Password:  </p></td>
					<td><input type="text" name="pass"></td>
				</tr><tr>
					<td><p></p></td>
					<td style="width:100%"></td>
				</tr><?php yCaptcha($s);?><tr>
					<td><p>&nbsp;     </p></td>
					<td><input type="submit" value="Go"></td>
				</tr>
			</form>
			</table>
			<p>&nbsp;</p>
			<br>
			<?php
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
					<img src="data:image/jpeg;base64,<?php echo base64_encode( $raw);?>"/>
				</td>
			</tr><tr>
				<td><p>Verify Code</p></td>
				<td><input type="text" name="ver" placeholder="Enter Captcha Code"></td>
			</tr><?php
	}
	function yAdmin(){
		?>
		<h2>Site Configuration</h2>
			<button type="button" class="right" onclick="yLogout()">Log out</button>
			<?php 
				editBegin(); 
				echo htmlspecialchars(file_get_contents('config.php'));
				editEnd(350); 
			?>
		<h2>Page Content</h2>
			<?php 
				editBegin(); 
				echo htmlspecialchars(file_get_contents('../index.php'));
				editEnd(350); 
			?>
		<h3>Stylesheet</h3>
			<?php
				editBegin(); 
				echo htmlspecialchars(file_get_contents('../lib/css/blue5.php'));
			editEnd(350, 'css'); 
	}
}
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once('yBlog.php');
$u = "";
$u	= @file_get_contents('pwd/user.txt');
$p = "";
$p	= @file_get_contents('pwd/pass.txt');
if (empty($u) || empty($p)){
	yLoginCreate($u, $p, true);
} else {
	yLoginShow($u, $p);
}
?>