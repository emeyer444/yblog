<?php // ------- yBlog Page Variables -----------------------//
	$TITLE 		= "Install"; 	//default=SITE_NAME
	$DESC			= "Installing the yBlog System";//default=SITE_DESC
	$AVATAR		= "img/yBlog2.jpg";			//default=SITE_LOGO
	$MENU_ORDER	= 4;					 	//default=1,0 = not menued
//	$AUTHOR		= "Author";			 	//default=SITE_AUTHOR
//	$STYLES		= "elegant");			//blue(default), none, box, elegant
include_once '../lib/yBlog.php';
//-----------------------------------------------------------//?>
<h2>Installation</h2>
<?php dates('Nov 2020', '', 'Beta .34: July 19, 2021') ?>
<p><b>Installation</b> is as simple as unzipping the files to any directory on your ISP server on 
on localhost. It's easiest to understand the setup by stepping through the PHP scripts that 
generate each page. It may look daunting, but there's not many files that require 
any modification.</p>
<table><tr><td>
<h2>Settug up Windows 10 Home</h2>
<p>Windows 10 Home has a built-in Webserver, but as Microsoft sells cloud and other Web services, it 
doesn't make it simple to install, sadly. It's easy once you've set it up, though. </p>
<ol><li>Open Control-Panel->Programs and features and switch to the "Turn Windows on or off" pane. 
Turn on all the "Internet Information Services" componenst and the "Internet Information Services Web 
Core." You will be prompted to restart your computer.
</li><li>In your browser, search for "web platform installer" and open the link to the Microsoft 
Store. Install, ignore the prompt saying there's nothing to do, and switch to the "Products" tab. 
Click the 'Name' header to sort by Name, scroll down to "PHP 7.4.13 (x64)", select it, and 
click the 'Install' button at the bottom of the panel. 
</li><li>In your browser, search for "Using PHP Manager for IIS to setup and configure PHP" and 
select the link to the Microsoft or IIS site, they are the same page. Install the PHP manager. 
It will create a widget in the IIS manager.
</li><li>In Windows Start, type "IIS" in the programs search field and select "IIS Manager." 
Find the PHP manager icon in it and double-click it. It will have a 'warning prompt.' Open it 
and accept the recommendation to change the home page to 'index.php.' 
</li><li>In the right edge of of the IIS manager, press the 'start' link, or press the 'restart' 
link if the Web service is already started. Minimize the IIS manager. 
</li><li>In Windows File manager, navigate to "C:\\inetpub\wwwroot". That is your FILE root 
for the Website. Delete the default files in that folder. Download the "cms.zip" in the downloads 
section of this page. Unzip it FIRST, then copy all its files to the wwwroot folder. 
</li><li>In your browser, type "localhost" in the browser. You will receive a prompt to enable 
directory browsing. Follow those instructions and double click on 'CMS.php.
</li></ol>
<p>BAM. your content creator shows up in your browser! Everything is much easier from now on. Lol.</p>
</td></tr?</table>
