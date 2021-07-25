<?php // ------- yBlog Page Variables -----------------------//
	$TITLE 		= "Plugins"; 	//default=SITE_NAME
	$DESC			= "Adding media and downloads to yBlog";//default=SITE_DESC
	$AVATAR		= "img/lightbox_demo.jpg";	//default=SITE_LOGO
	$MENU_ORDER	= 2;					 	//default=1,0 = not menued
//	$AUTHOR		= "Author";			 	//default=SITE_AUTHOR
//	$STYLES		= "elegant");			//blue(default), none, box, elegant
include_once '../lib/yBlog.php';
//-----------------------------------------------------------//?>
<h3>Introduction</h3>
<?php dates('Nov 2020', 'July 7, 2021', 'Beta .33: July 7, 2021'); ?>
<p>Most plugins are tiny snippets of code which can be inserted anywhere in the 
body content, with a few parameters to configure the inserted code. Parameters are often
 optional, and some plugins operate automatically without even needing a snipppet 
to trigger them. If the snippets are PHP, the Webserver substitutes large, 
well-formed blocks of code for the snippet, so the functions to insert the 
snippets are never seen in the client browser. If the snippets are JavaScript, the Web 
browser inserts the blocks of code while the document is being loaded. In that case, 
the inserted blocks of code are not in the page source, but they are visible in the 
'Elements' trees of browser development tools.</p>
<h2>yTOC plugin</h2>
<p id='h2tocHere'>Unlike most other yBlog plugins, the yTOC plugin is in 
the <code>ySite</code> JavaScript class at the end of the client <code>BODY</code>. 
It executes BEFORE the page is fully loaded, and before the stylesheet is applied to the 
HTML content of the file, when only the Document Object Model (DOM) 
structure of the page has been parsed. This means it does not cause any layout shift 
when the page is displayed. Surprisingly, it does not delay page display as much as 
one might expect, and is in fact extremely quick. This is because the DOM structure 
of the TOC itself, and the named anchors which it adds before the headings, does not need 
to be included in the fetched page (reducing file size), and also, the DOM of the fetched 
page is simpler. Hence rather than there being a performance penalty, in some browsers 
on some machines, the page will actually render and load more quickly.</p>
<?php yToc('H2', 'h2tocHere', 'right'); ?>
<p>The yTOC plugin automatically generates the TOC at the top of the article 
from level-2 heads, also adding anchors before each <code>H2</code>. Page content 
can also call the yTOC plugin to create a similar TOC for <i>any</i> set of HTML tags in 
the document. For example, the yTOC plugin generated the jumplist to <code>H3</code> tags
in this section.<p>
<p>To insert a yTOC plugin on a page as shown, first give the tag AFTER the location to 
insert the TOC a unique ID. The TOC floats to the right, so it will align with the 
top of that element block on the right side of the page. All IDs inserted by the Blog 
Creator begin with the letter 'y', so if the ID begins with any other letter, 
there won't be a namespace conflict. </p>
<p>Then place the following snippet before that tag, and the TOC 
will float to the right of the following block element. This example creates a TOC from 
<code>H5</code> tags and inserts it before the paragraph with an ID of 'H5toc'.</p>
<?php codeBegin(); ?>
    <p id="tocDemo">TOC appears above this element.</p>
    &lt;?php yToc('H2', 'tocDemo', 'right', 'note'); ?><?php 
codeEnd(); ?>
<p>The yTOC plugin currently cannot be inserted for the same set of tags more than once. 
This and additional enhancements are planned.</p>
<h2>download() Plugin</h2>
<p>This plugin makes a download button, automatically adding its filesize in human readable format:</p>
<?php download('cms.zip'); ?>
<p>To insert the plugin, place the zipfile in the ./inc/ subdirectory, copy this snippet 
into your page editor, and change <i>filename.zip</i> to the file you wish to have downloaded.
<?php codeBegin(); ?>

    &lt;?php download('filename.zip'); // Inserts download button  ?>
<?php codeEnd(); ?>
<h2>YouTube Plugin</h2>
<p>This plugin embeds a YouTube player. To set the video, open the video in YouTube and copy 
the numeric string after the URL's last slash, and insert it into this snippet.</p>
<?php codeBegin(); ?>

    &lt;?php video('id' {,['left'|'right[']}); // Embeds YouTube Video ?>
<?php codeEnd(); ?>

<?php video('C-u5WLJ9Yk4', 'left');  ?>
<h2>PDF Reader Plugin</h2>
<p>The PDF reader has a fallaback to native HTML5 support viewing Acrobat files, but currently 
the native HTML5 reader only works on desktops with Chrome, Safari, and Edge. To enable a 
reader which works on all platforms, go to <a href="http://www.adobe.com/products/acrobat/readstep2.html">
Adobes's Acrobat download page</a> and obtain an ID for the embedded Adobe DC Acrobat reader SDK, 
and put the ID in this package's <i>lib/config.php</i> file. It will only work on your remote 
server and not on localhost, not all features are supported on all devices, and PDF indices 
don't work at all, but it will do at least something on all devices.</p>
<p>To embed the Acrobat reader in a page, first ensure that the <code>$reader</code> variable 
at the top of the content page template is set to '1.' Then copy the PDF to the <i>./inc</i> 
subdirectory, and replace <i>filename</i> in the following snippet with the PDF's filename. 
The filename is case-sensitive and should end with <i>.pdf</i>. Be careful to keep the 
quotes around the filename. A future release will include buttons for a better full-screen 
reader, download, and user help.</p>
<?php codeBegin(); ?>
    &lt;?php pdfViewer('filename'); // Embeds Adobe DC Acrobat viewer ?><?php 
	 codeEnd(); ?>
<?php pdfViewer('sample.pdf');   ?>
<h2>Lightbox Plugin</h2>
<p>JavaScript at the page's end automatically adds a captioned lightbox slideshow 
to all IMG elements on the page. The IMG element's ALT attribute sets the caption 
displayed in the lightbox for each image. The content writer simply needs to 
include a standard image tag. Optionally, the tag may include a <code>CLASS="left"</code> 
or <code>CLASS="right"</code> tag to float the image to left or right of the text. 
<code>&lt;BR&gt;</code> tags can force a column break before or after the <code>&lt;IMG&gt;</code>
tag. a STYLE attribute may also over-ride the default height and width.</p>
<?php codeBegin(); ?>
<img src="img/lightbox_demo.jpg" style="width:150px" alt='yBox Lightbox Demo'> <?php 
codeEnd(); ?>
<img src="img/lightbox_demo.jpg" style="width:150px" alt='yBox Lightbox Demo'> 
<br>
<h2>Syntax-Highlighter Plugin</h2>
<p>To highlight code, place <i>codeBegin()</i> and <i>codeEnd()</i> around the 
text to highlight. Note, curently, the opening bracket of 
<code><span style='color:red'>&lt;?PHP</span></code>
and <code>&lt;?/TEXTAREA></code> must currently be replaced with an &lt; entity 
so as not to break the parser (to be performed automatically in a future release). </p>
<?php codeBegin(); ?>
&lt;?PHP codeBegin(); ?> 
//Text here is syntax highlighted. codeEnd() has the following options:
    &lt;?php highlighter({php|clike}{, {$height}, ($theme}}} ); ?>
&lt;/TEXTAREA>
    &lt;?php highlighter( // highlights code in above TEXTAREA ?>
            $mode   = 'php',        // syntax(default PHP,HTML5,& CSS. 'clike' = C/C++ 
            $height = '0',              // rows, defaults to code length
            $theme  = 'dracula'     // color theme, defaults to black background
<?php codeEnd(); ?>
<h2>Document Details Plugin</h2>
<p>This plugin creates a table of file details which floats to the right 
of the paragraph following it.</p>
<?php codeBegin(); ?>

&lt;?php dates($created,$modified,$revision); ?>
<?php codeEnd(); ?>

<h2>Animations</h2>
<p>Currently the Blog Creator supports snow animation via pure JavaScript in Chrome, Internet Exploere 10, and Edge browsers. 
More animations may be added.</p>


<h2>Blog List</h2>
<p>Currently yBlog has a special page to support lists of all the pages in a directory, which is planned to become 
a plugin for articles and side modules in a future beta. all that is necessaary is to set a few variables 
at the top of the blog listing page.</p>
<?php codeBegin();
	echo htmlspecialchars(file_get_contents('../index.php'));
codeEnd(); ?>









