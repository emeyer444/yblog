<?php // --------------------- BODY -------------------------------------------
define("FILE_DIR" , dirname  (FILEPATH).'/');
require 'config.php';
require 'plugins.php';
ob_start(); // Start the output buffer
?>
<BODY ID='yBody' itemscope itemtype="http://schema.org/Webpage">
	<HEADER ID="yHeader">
		<NAV ID='yNav'>
			<A HREF="<?php echo SITEURL ?>" id="yLogo"></A>
<?php 	
	ySiteMenu(SITE_ROOT, SITEURL);
	if(PAGE_DIR != SITEURL && strpos(PAGE_URL, SITEURL.'lib/') !== 0){
		ySiteMenu(FILE_DIR, PAGE_DIR);
	}
?>
			<DIV ID='yBtn' class="yClick" data-nosnippet>Go&nbsp;to&nbsp;Top</DIV>
			<DIV ID="yHideMenu" class="yClick" data-nosnippet>Hide&nbsp;Menu</DIV>
			<DIV ID='yShowMenu' class="yClick" data-nosnippet>Show&nbsp;Menu</DIV>
		</NAV>
	</HEADER>
<DIV ID="ySpacer">  
	<ASIDE ID='yNews'>
		<CODE>
			<span data-nosnippet><?php echo SITE_DESC; ?><br>
			<BR>
			<B>NOTICE:</B> yBlog v0.34 will be available for download Monday. </span>
		</CODE>
	</ASIDE>
<?php
//----------------------------------
if ($PAGE_TYPE == 'Blog'){ ?>
	<SECTION id="ySection" itemscope itemtype="http://schema.org/Blog">
<?php 
	$avatar = (isset($AVATAR))? PAGE_DIR.$AVATAR : SITEURL.SHARING_LOGO ;
	yMeta($TITLE, $AUTHOR, $PAGE_TYPE, PAGE_URL, MODIFIED, $avatar); ?>
	<H1><span data-nosnippet><?php echo $TITLE; ?></span></H1><br>
<?php 
	include (FILEPATH);
	yBlogList($BLOG_DIR, FILENAME); ?>
	</SECTION>
<?php 
	$ADOBE_ON 	 = 0;
	$CODEVIEW_ON = 0;
	include ('foot.php');
//----------------------------------
} else if ($PAGE_TYPE == 'Website' && FILENAME == 'index.php'){ ?>
	<MAIN id="yMain" itemscope itemtype="http://schema.org/Website">
<?php 
	$avatar = "";
	yMeta($TITLE, $AUTHOR, $PAGE_TYPE, PAGE_URL, MODIFIED, $avatar);
$ADOBE_ON 	 = 0;
$CODEVIEW_ON = 0;
	include 'index.php'; ?>
	</MAIN>
<?php 
} else { 
?>
	<ARTICLE id="yArticle" itemscope itemtype="http://schema.org/Article">
<?php  
	$avatar = (isset($AVATAR))? PAGE_DIR.$AVATAR : SITEURL.SHARING_LOGO ;
	yMeta($TITLE, $AUTHOR, $PAGE_TYPE, PAGE_URL, MODIFIED, $avatar); ?>
		<DIV class='yFlex'>
			<DIV style="flex-basis:300px;flex-shrink:1;flex-grow:1">
				<H1><span data-nosnippet><?php echo $TITLE; ?></span></H1>
				<BR />
				<H3 CLASS='desc'><CODE><?php echo $DESC; ?></CODE></H3><?php 
if(isset($AVATAR)){ ?>

				<IMG ID='yAvatar' ALT="<?php echo $DESC;?>" SRC="<?php echo $AVATAR;?>"/><?php
}
?>

			</DIV>
			<DIV STYLE='flex-shrink:1;flex-grow:1'>
<?php 	
	yToc('H2', 'right', "(Click the images for a lightbox slideshow)");
?>
			</DIV>
		</DIV>
<?php 	
$ADOBE_ON 	 = 0;
$CODEVIEW_ON = 0;
	require (FILEPATH); 
?>
	</ARTICLE>
<?php 
} 
//----------------------------------
?>
<div style="height:100px"></div>
</DIV> 
</BODY>
<?php  
$body = ob_get_clean();
yThumb($body, $DESC);
yAnchors($body,'H2');
// --------------------- HEAD -------------------------------------------
ob_start(); ?>
<HEAD>
	<BASE href="<?php echo PAGE_URL; ?>">
	<link rel="canonical" href="<?php echo PAGE_URL; ?>"/>
	<link rel="shortcut icon" href="<?php echo SITEURL; ?>favicon.ico">
	<TITLE><?php echo $TITLE; ?></TITLE><?php 
if(FILENAME != '404.php'){
	$avatar = (isset($AVATAR))? PAGE_DIR.$AVATAR : SITEURL.SHARING_LOGO ;
	yHeadMeta($TITLE, $DESC, $AUTHOR, $PAGE_TYPE, $avatar);
}
if($CODEVIEW_ON == true) yCodeViewer($CODETHEME);
//if($WYSIWIG == true) yTiny();
yAnalytics();
if($ADOBE_ON == true) yAdobe();
	require 'js.php';
	require 'styles.php'; ?>
</HEAD>
<?php 
$head = ob_get_clean();
// --------------------- HTML -------------------------------------------
$html = "<!DOCTYPE HTML>\n<HTML LANG=\"en\">".$head.$body."\n</HTML>\n";
if (!IS_LOCALHOST) 
	yMinimize($html);
if(YCACHE && $PAGE_TYPE != 'Website'){
	$html .="<!-- Cached copy, generated ".date('m/d/Y h:i:s a', time())." -->";
	$f = gzopen(CACHEFILE, 'w9');// Cache the contents to a cache file
	gzwrite($f, $html);
	gzclose($f);
	header ('Vary: Accept-Encoding');
	header ('Content-Encoding: gzip');
	readfile(CACHEFILE); // Send the output to the browser
} else {
	echo $html;
}
exit();
?>
