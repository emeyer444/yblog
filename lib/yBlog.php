<?php  // yBlog.php -- generate website from a few variables
$file = $_SERVER['SCRIPT_FILENAME'];
define("FILEPATH"	, str_replace('\\', '/',$file));
define("MODIFIED" , filemtime(FILEPATH)); 
define("FILENAME"	, basename (FILEPATH));
define("BASENAME"	, substr_replace(FILENAME ,"",-4));
define("CACHEFILE", 'cached-'.BASENAME.'.gz');
define("YCACHE"	, false );
if (YCACHE && file_exists(CACHEFILE) && filemtime(CACHEFILE) > MODIFIED){
		header ('Vary: Accept-Encoding');
		header ('Content-Encoding: gzip');
		readfile(CACHEFILE);
		exit();
} else {
	clearstatcache();
	// debug();
	require 'body.php';
}
?>