<?php //login.php -- to access admin.php
	$TITLE 		= "yBlog Administration";	//default=SITE_DESC
	$DESC			= "";	//default=SITE_DESC
	$AVATAR		= "";	//default=SITE_LOGO
	$MENU_ORDER	= 8;					 	//default=1,0 = not menued
	$PAGE_TYPE	= "Website";			//Article (default), Blog, Website
//	$CODEVIEWER = true; 					//default=false
include_once 'yBlog.php';
//--------------------------------------------------------------
if (session_status() === PHP_SESSION_NONE){ 
	 //if(IS_LOCALHOST) session_set_cookie_params(1800, '/', 'localhost');
	 //else	
     $maxlifetime = 1800;
	  session_set_cookie_params([
            'lifetime' => $maxlifetime,
            'path' => '/',
            'domain' => $_SERVER['HTTP_HOST'],
            'secure' => true,
            'httponly' => true,
            'samesite' => 'Strict'
        ]);
	 session_start(); 
//	$_SESSION["login_attempts"] = 0;
}
//if (isset($_SESSION["locked"])) {yLock();} else {
	$user=""; $pass=""; $ver=""; 
	include_once('admin.php');
	$u = ""; $u	= @file_get_contents('pwd/user.txt');
	$p = ""; $p	= @file_get_contents('pwd/pass.txt');
	if (empty($u) || empty($p)){
		yLogin($u, $p, 'New');
//	} 	else if (querystring == 'change'){ 
//		// delete files;
//		yLogin($u, $p, 'Change'); 
	} else {
		$x = yLogin($u, $p, 'Administrator'); 
	} if ($x == true) { ?>
			<h2>Site Configuration</h2>
			<p>Welcome, <?php echo $user?>, you are logged in. </p>
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
				<input type="submit" class="button" name="refresh" value="Refresh" />
				<input type="hidden" name="action" value="refresh">
				<input type = "hidden" name = "user"   value = "<?php echo htmlspecialchars($user);?>">
				<input type = "hidden" name = "pass"   value = "<?php echo htmlspecialchars($pass);?>">
				<input type = "hidden" name = "ver"    value = "<?php echo htmlspecialchars($_SESSION["ver"]) ;?>">
			</form>
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
				<input type = "submit" class=" button" name =  "logout" value = "Logout" />
				<input type = "hidden" name = "action" value = "logout">
			</form>
	<?php
	}
// }
?>