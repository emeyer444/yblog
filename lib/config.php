<?php if(!defined('SITEURL')){
//--------------------------------------------------------------------------------
// config.php. Site confoguration
	define("REMOTE_SITE_URL" 		, "myserver.com");
	define("LOCAL_ROOT_URL"  		, "localhost/yblog");
	define("SITE_NAME"		 		, "My Server");
	define("SITE_DESC"		 		, "yBlog Demo.");
	define("SITE_AUTHOR"		 		, "Ernest Leonardo Meyer");
	define("SITE_LOGO"		 		, "lib/img/logo.png");
	define("SHARING_LOGO"	 		, "lib/img/logo_square.jpg");//200x200 pixels required
	define("GOOGLE_ANALYTICS_ID"	, "");
	define("ADOBE_SDK_KEY"			, "");
} // Page Defaults
if(!isset($CODETHEME )){$CODETHEME  = 'erlang-dark';}
if(!isset($STYLES	  	)){$STYLES	   = 'blue'			;}
if(!isset($ANIMATE	)){$ANIMATE	   = true			;}
if(!isset($MENU_ORDER)){$MENU_ORDER = 0;				;}
$var_nav = "rgba(0,0,0,.66)";// needed in both css and javascript
//--------------------------------------------------------------------------------------
// yBlog magic. DON'T CHANGE!!
//--------------------------------------------------------------------------------------
if(!isset($TITLE     )){$TITLE      = SITE_NAME		;}
if(!isset($DESC      )){$DESC		   = SITE_DESC		;}
if(!isset($AUTHOR    )){$AUTHOR     = SITE_AUTHOR	;}
if(!isset($BLOG_DIR  )){$BLOG_DIR   = "";				;}
if(!isset($PAGE_TYPE )){$PAGE_TYPE  = 'Article'		;}
if(!defined('SITEURL')){
	define("PROTOCOL" , ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS']!='off') 
		|| $_SERVER['SERVER_PORT']==443)? "https://" : "http://");
	define("SITE_ROOT", substr(__DIR__, 0, strlen(__DIR__) - 3));
	$whitelist = array("localhost", REMOTE_SITE_URL);//for downloads
	$localhosts = array("127.0.0.1", "::1");
	if(in_array($_SERVER['REMOTE_ADDR'], $localhosts)){
		define("SITENAME" 	, "Localhost");
		define("SITEURL"  	, PROTOCOL.LOCAL_ROOT_URL.'/'); 
		define("ANALYTICS"	, "0");
		define("ADOBE_KEY"	, "0");
		define("IS_LOCALHOST", true);
	} else {
		define("SITENAME" 	, "Yofiel");
		define("SITEURL"  	, PROTOCOL.REMOTE_SITE_URL.'/');
		define("ANALYTICS"	, GOOGLE_ANALYTICS_ID);
		define("ADOBE_KEY"	, ADOBE_SDK_KEY);	
		define("IS_LOCALHOST", false);
	}
	define("PAGE_URL"	, PROTOCOL . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
	define("PAGE_TEST", dirname(PAGE_URL).'/');
	if(strcasecmp(PAGE_TEST, SITEURL) != 0 && strcasecmp(PAGE_URL, SITEURL) !=0){	
		define("PAGE_DIR" 	 , PAGE_TEST);
		define("PAGE_DIR_REL" , str_replace(SITEURL, '', dirname(PAGE_URL)).'/');
	} else {
		define("PAGE_DIR"     , SITEURL);	
		define("PAGE_DIR_REL" , '');	
	} 
}?>