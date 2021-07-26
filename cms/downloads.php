<?php // ------- yBlog Page Variables -----------------------//
	$TITLE 		= "Downloads"; 	//default=SITE_NAME
	$DESC			= "yBlog downloads and release history";//default=SITE_DESC
	$AVATAR		= "img/yBlog2.jpg";			//default=SITE_LOGO
	$MENU_ORDER	= 6;					 	//default=1,0 = not menued
//	$AUTHOR		= "Author";			 	//default=SITE_AUTHOR
//	$STYLES		= "elegant");			//blue(default), none, box, elegant
include_once '../lib/yBlog.php';
//-----------------------------------------------------------//?>
<h2>Download</h2>
<p>The beta .34 release of Yofiel's CMS is freely downloadable at this link under public-domain 
MIT license which places no restrictions on its usage:</p>
<?php download('cms.zip'); ?>
<h2>Currently in Development</h2>
<ul><li>PDF viewer in full-screen lightbox.
</li><li>Automated generation of images sized to page display.
</li><li>Lazy load of full-size images for lightbox carousels.
</li><li>Automated insertion of image and subsection metadata.
</li><li>Administrator panel.
</li><li>WYSIWIG editing.
</li><li>Live template switching.
</li><li>Automated sitemap generatioN and server cache refresh. 
</li></ul>
<h2>Release History</h2>
<h3>Beta .34 (July 17, 2021)</h3>
<ol><li>Automated nested menu generation and suport of content pages in subdirectories.
</li><li>Microdata for articles and blogs updated to current Google and Microsoft specifications.
</li><li>Selection of different colors, box shadowing, and box rounding for each page 
</li><li>Smooth scrolling and menu animations on all devices. 
</li><li>Automated whitespace removal and script minification. 
</li></ol>
<h3>Beta .33 (June 27, 2021)</h3>
<ol><li>.htaccess: protected directories and prevention of hotlinks to download-files. 
</li><li>Transparent support for localhost on Windows 10 IIS, Xampp, and MacOS.  
</li><li>Blog moveable to any directory on any server simply by changing one variable. 
</li><li>JavaScript: Cookies for EU compliance and restoring menu state on opening new pages.
</li><li>JavaScript: automatically highlights current page in NAV menu.
</li><li>JavaScript: slideshow disabled, lightbox only, if only one picture on page
</li><li>Lightbox slideshow: button appearance conforms with site appearance.
</li><li>Lightbox slideshow: last picture no longer shows twice.
</li><li>Plugins: Automatic generation of TOCs and anchor inserton for them.
</li><li>Plugins: added quickhand PHP codes for plugin insertion.
</li></ol> 
<h3>Beta .32 (June 1, 2021)</h3>
<ol><li>Conditional testing enables all files to work on server and localhost without change
</li><li>NAV: all inline CSS moved to stylesheet for better responsive layout
</li><li>HTML/CSS: Cookie notice added for EU compliance. 
</li><li>HTML/CSS: page now fully responsive on all devices, with hideable menu. 
</li><li>CSS: Improved content layout on mobile devices (menu still in progress)
</li><li>CSS: ASIDE, FOOTER, H4, H5, H6, and MAIN layouts added.
</li><li>Background animation: disabled on Safari and movile devices
</li></ol>
<h3>Beta .31 (May 27, 2021)</h3>
<ol><li>Plugins: added Adobe plugin for better browser compatibility for Acrobat reader.o
</li><li>HTML/CSS: Simplified template; avatar and description on top of all pages. 
</li><li>HTML/CSS: table .date class added for file creation and revision. 
</li><li>JavaScript: snow animation added. 
</li><li>JavaScript: current page hightlights in menu. Improved 'top of page' button. 
</li><li>CSS: justified paragraph, list, and table layout with improved margins. 
</li><li>.htaccess: security, hotlink protection, compression, and client caching added. 
</li></ol>
<h3>Beta .30 (May 1, 2021)</h3>
<ul><li>First documented beta
</li></ul>
<blockquote><p>With thanks to George Milkov for assitance.</p></blockquote>
