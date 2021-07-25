<?php // ------- yBlog Page Variables -----------------------//
	$TITLE 		= "Creating blog pages"; 	//default=SITE_NAME
	$DESC			= "Content creation in yBlog's file-based blog system ";//default=SITE_DESC
	$AVATAR		= "img/yBlog2.jpg";			//default=SITE_LOGO
	$MENU_ORDER	= 1;					 	//default=1,0 = not menued
//	$AUTHOR		= "Author";			 	//default=SITE_AUTHOR
//	$STYLES		= "elegant");			//blue(default), none, box, elegant
include_once '../lib/yBlog.php';
//-----------------------------------------------------------//?>
<h2>Setting the Page Variables</h2>
<?php dates('Nov 2020', '', 'Beta .34: July 11, 2021') ?>
<p>At its top, the simple PHP template code contains a handful of variables 
from which the entire page is built. yBlog sets defaults for all the page variables, 
but you will generally wish to set at least the page title and description.</p>
Here is the code for this page, for example:</p>
<?php 
	codeBegin(); 
	echo htmlspecialchars(file_get_contents('setupPage.php'));
	codeEnd(350); 
?>
<p><i>Specifications for the variables are in preparation</i></p>