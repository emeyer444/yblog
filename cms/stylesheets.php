<?php // ------- yBlog Page Variables -----------------------//
	$TITLE 		= "Stylesheets"; 	//default=SITE_NAME
	$DESC			= "Modifying the appearance of yBlog content";//default=SITE_DESC
	$AVATAR		= "img/yBlog2.jpg";			//default=SITE_LOGO
	$MENU_ORDER	= 3;					 	//default=1,0 = not menued
//	$AUTHOR		= "Author";			 	//default=SITE_AUTHOR
//	$STYLES		= "elegant");			//blue(default), none, box, elegant
include_once '../lib/yBlog.php';
//-----------------------------------------------------------//?>
<h2>Stylesheet Design</h2>
<?php dates('Nov 2020', '', 'Beta .34: July 19, 2021') ?>
<p>CSS-styled cascades include <code> A, ARTICLE, ASIDE, B, BLOCKQUOTE, 
BODY, BR, CODE, DATA, DETAILS, DIV, DD, DL, DT, 
EM, H1, H2, H3, HEADER, HTML, I, IFRAME, IMG, LI, MAIN, NAV, OBJECT, OL, P, PRE, 
STRONG, SUB, SUMMARY, SUPER, TABLE, TD, TH, TR, TEXTAREA, U, UL</code>, and 
<code> ACTIVE/FOCUS/HOVER</code> pseudoclasses.</p>
<p>The stylesheet is generated from a PHP file which sets the colors,
box rounding, box shadows, and animations from the 
<i> ./lib/config.php</i >variables.</p>
<h2>Formatting Examples</h2>
<p>The above heading is an <code> H2</code> heading (and appears in 
the on-page TOC). The following formatting examples are nested inside 
a <code> BLOCKQUOTE</code> element.
<blockquote>
<h3>Paragraphs, Characters, and Lists</h3>
<p>The above heading is a <code>H3</code> heading. This is a 
Paragraph (<code>&lt;P></code>) Element. It may contain  
<b> Bold (&lt;B>)</b>, <i> Italic (&lt;I>)</i>, <em> Bold Italic (&lt;EM>)</em>, 
<strong> strong (&lt;strong>)</strong>, <code> code (&lt;CODE>)</code>, plus 
<sub> Subscript (&lt;SUB>)</sub> and <sup> Superscript (&lt;SUP>)</sup> character elements.</p>
<ul><li>This is a first-order list, bulleted (starts with 
<code>&lt;UL>&lt;LI></code>).
<ol><li>This is a second-order list, numbered (starts with 
<code> &lt;OL>&lt;LI></code>).
</li><li>All list items after 1<sup>st</sup> are preceded 
by <code> &lt;/LI>&lt;LI></code>)
</li><li>This is the last item in the second-rder list (followed by 
<code> &lt;/LI&lt;OL></code>).
</li></ol>
</li><li>This is the end of unordered list (followed by 
<code> &lt;/LI&lt;UL></code>)
</li></ul>
<h4>Tables</h4>
<p>The above heading is a <code> &lt;H4></code> element.</p>
<TABLE><TR><TD>This is the first row in a table inside a blockquote 
element, using the native <code> TD</code> font.
</td></tr><tr><td><p>This is a paragraph iinside the second row inside 
a <code> P</code> element. If text is inside the paragraph
element, it appears like other paragraphs. If text is directly inside 
a table cell, it doesn't break into paragraphs unless there is a 
<code> &lt;BR></code> element</p>
</td></tr><tr><td>This is the last row in a table
</td></tr></table>
<br>
</blockquote>
<h2>Stylesheet Listings</h2>
<p>The defaults can be overriden for any page, but will still be used on the 
system 'Page not Found' Error page. The {BLUE, ROUNDED, SHADOWED, SNOW} 
template follows.</p>
<?php
	editBegin(); 
	echo htmlspecialchars(file_get_contents('../lib/styles.php'));
	editEnd(350, 'css'); 
?>
<p>The <code>:root</code> values are applied to the shared stylesheet listed 
below it.</p>
