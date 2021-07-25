<?php  // yBlog.php -- generate website from a few variables
if(defined('FILEPATH')){ return; }
$backtrace = debug_backtrace();
$file      = $backtrace[0]['file'];
define("FILEPATH"	, str_replace('\\', '/',$file));
define("FILE_DIR" , dirname  (FILEPATH).'/');
define("FILENAME"	, basename (FILEPATH));
define("MODIFIED" , filemtime(FILEPATH)); 
require_once 'config.php';
require_once 'plugins.php';
//$debug = true; debug();
// --------------------- BODY -------------------------------------------
$ADOBE_ON 	 = false;
$CODEVIEW_ON = false;
ob_start(); ?>
<BODY ID='yBody' itemscope itemtype="http://schema.org/Webpage">
	<HEADER ID="yHeader">
		<NAV ID='yNav'>
			<A HREF="<?php echo SITEURL ?>" id="yLogo"></A>
<?php 	
	ySiteMenu(SITE_ROOT, SITEURL);
	if(PAGE_DIR != SITEURL && PAGE_DIR != SITEURL.'lib/'){
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
//	yMeta($TITLE, $AUTHOR, $PAGE_TYPE, PAGE_URL, $MODIFIED, $AVATAR); ?>
	<H1><span data-nosnippet><?php echo $TITLE; ?></span></H1><br>
<?php 
	include (FILEPATH);
	yBlogList($BLOG_DIR, FILENAME); ?>
	</SECTION>
<?php 
	include ('foot.php');
//----------------------------------
} else if ($PAGE_TYPE == 'Website' && FILENAME == 'index.php'){ ?>
	<MAIN id="yMain" itemscope itemtype="http://schema.org/Website">
<?php 
	yMeta($TITLE, $AUTHOR, $PAGE_TYPE, PAGE_URL, $MODIFIED, $AVATAR);
	include 'admin.php'; ?>
	</MAIN>
<?php 
} else { 
?>
	<ARTICLE id="yArticle" itemscope itemtype="http://schema.org/Article">
<?php  
	yMeta($TITLE, $AUTHOR, $PAGE_TYPE, PAGE_URL, MODIFIED, $AVATAR); ?>
		<DIV class='yFlex'>
			<DIV style="flex-basis:300px;flex-shrink:1;flex-grow:1">
				<H1><span data-nosnippet><?php echo $TITLE; ?></span></H1>
				<BR /><?php	if($DESC != ""){?>
				<H3 CLASS='desc'><CODE><?php echo $DESC; ?></CODE></H3><?php
		}
		if($AVATAR != SITEURL){
		?>
				<IMG ID='yAvatar' ALT="<?php echo $DESC;?>" SRC="<?php echo $AVATAR;?>"/>
		<?php 
		} ?>
			</DIV>
			<DIV STYLE='flex-shrink:1;flex-grow:1'>
				<DIV ID="yLeader">
				</DIV>
			</DIV>
		</DIV>
<?php 	
	require (FILEPATH); ?>
	</ARTICLE>
<?php 
} 
//----------------------------------
?>
</DIV>  
</BODY>
<?php  
$body = ob_get_clean();
//preg_match_all('/<img[^>]+>/i',$src, $imgs); 
//foreach ($imgs as $img){
//	print_r($img);
//}
// --------------------- HEAD -------------------------------------------
ob_start(); ?>
<HEAD>
	<BASE href=" <?php echo PAGE_URL; ?>">
	<link rel="canonical" href="<?php echo PAGE_URL; ?>"/>
	<link rel="shortcut icon" href="<?php echo SITEURL; ?>favicon.ico">
	<TITLE><?php echo $TITLE; ?></TITLE><?php 
	if(FILENAME != '404.php')
		yHeadMeta($TITLE, $DESC, $AUTHOR, $PAGE_TYPE, $AVATAR);
	if($CODEVIEW_ON == true) yCodeViewer($CODETHEME);
	//yTiny();
	yAnalytics();
	if($ADOBE_ON == true) yAdobe();
	require 'js.php';
	require 'styles.php'; ?>
</HEAD>
<?php
$head = ob_get_clean();
// --------------------- HTML -------------------------------------------
$html = '<!DOCTYPE html>.<HTML LANG="en">'.$head.$body.'</HTML>';
yMinimize($html);
echo $html;
exit();
?>