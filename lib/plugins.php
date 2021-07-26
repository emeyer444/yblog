<?php /**** plugins.php for Yofiel's Blog Creator ****/
	$counter = 1000; //for unique ID when multiple objects of same type are on same page 
/**** <?php dates(); ?>       	// Inserts page dates ****/
function dates(
				$created		= "",		// Default: current year 
				$modified 	= "",  	// Default: file modified time
				$revision	= ""){	// Default: no revision row
	?>
	<TABLE CLASS='date'>
 		<TR><TD>Created: <?php 
			if ($created	=== "") {
				$created = date("Y", MODIFIED);
			}
	echo $created ?></TD></TR>
		<TR><TD>Modified: <?php 
			if ($modified === "") {
				$modified = date("m/d/y", MODIFIED);
			}
	echo $modified; ?></TD></TR>
		<?php 
			if($revision !== ""){ ?>
		<TR><TD><?php echo $revision; ?></TD></TR><?php
			} ?>
	</TABLE>
<?php
}
/**** <?php download($file); ?>       // Inserts download button  ****/
function download($file, $date = ""){
	global $siteUrl;
	if ($date == ""){ 
		$date = date('m-d-y', filemtime(SITE_ROOT.'inc/'.$file));
	}
	?>
	<FORM ACTION="<?php 
			echo SITEURL;?>lib/download.php" METHOD="POST" CLASS="download">
		<INPUT TYPE="submit" NAME="download" VALUE="Download <?php
			echo $file;?> (<?php 
			echo $date;?>; <?php
			echo formatBytes(filesize(SITE_ROOT.'inc/'.$file))?>)">
		<INPUT TYPE="hidden" NAME="filename" VALUE="<?php echo $file; ?>" />
	</form>
	<?php
}
/**** <?php video($id, $float); ?>   // Embeds video  ****/
function video($id, $float = 'right'){
	?>
	<IFRAME
		 
		CLASS=<?php echo $float; ?>
		WIDTH="350" 
		HEIGHT="280" 
		SRC="https://www.youtube.com/embed/<?php echo $id; ?>">
	</IFRAME>
	<?php
}
/**** <?php pdfViewer($filename); ?>    // Embeds PDF reader  ****/
function pdfViewer($filename){
	global $counter; 
	global $ADOBE_ON;
	$counter++;
	if (ADOBE_KEY !== "0"){  
		$ADOBE_ON = true; ?>
		<DIV CLASS="yReader" ID="yPdf<?php 
					echo $counter; ?>" ></div>
		<SCRIPT>
			document.addEventListener("adobe_dc_view_sdk.ready", function(){ 
				var adobeDCView = new AdobeDC.View({clientId: "<?php 
						echo ADOBE_KEY; ?>", divId: "yPdf<?php 
						echo $counter; ?>"});
				adobeDCView.previewFile({
					content:{location: {url: "<?php echo
						SITEURL.'inc/'.$filename; ?>"}},
					metaData:{fileName: "<?php 
						echo $filename; ?>"}
				}, {embedMode: "SIZED_CONTAINER"});
			} );
		</SCRIPT>
	<?php
	} else { 
		$id = 'yPdf'.$counter;
		?>
		<DIV style = 'box-sizing:border-box;height:auto;margin:8px auto;max-width:90%;
					padding:0;text-align:center'>
			<embed 
				id		 = "<?php echo $id; ?>"
				src	 = "<?php echo SITEURL.'inc/'.$filename; ?>" 
				alt	 = "pdf" 
				pluginspage="http://www.adobe.com/products/acrobat/readstep2.html"
			>
		</DIV>
		<script>
			window.addEventListener("load", function(){
				var w = window.innerWidth;
				var h = window.innerHeight;
				if (w > 600){
   	 			ySite.id('<?php echo $id; ?>').setAttribute('width', "600");
   	 			ySite.id('<?php echo $id; ?>').setAttribute('height', "500");
				} else {
   	 			ySite.id('<?php echo $id; ?>').setAttribute('width', "400");
   	 			ySite.id('<?php echo $id; ?>').setAttribute('height',"400");
				}
			});
			window.addEventListener("resize", function(){
				var w = window.innerWidth;
				var h = window.innerHeight;
				if (w > 600){
   	 			ySite.id('<?php echo $id; ?>').setAttribute('width', "600");
   	 			ySite.id('<?php echo $id; ?>').setAttribute('height', "500");
				} else {
   	 			ySite.id('<?php echo $id; ?>').setAttribute('width', "400");
   	 			ySite.id('<?php echo $id; ?>').setAttribute('height', "500");
				}
			});
		</script>
		<?php
	}
}
/**** <?php codeBegin(); ?> 					// starts code highlighting ****/
function codeBegin(){
	global $counter; 
	global $CODEVIEW_ON;
	$CODEVIEW_ON = true;
	$counter++;
	?>
	<TEXTAREA ID="codeEdit<?php
		echo $counter; ?>">
	<?php
}
/**** <?php codeEnd() ?> 					// ends code highlighting ****/
function codeEnd(
						$height = 0,			  // rows, defaults to code length
						$mode   = 'php',  		// syntax(default PHP,HTML5,& CSS. 'clike' = C/C++ 
						$theme  = ''		// color theme.
					){
	global $counter;
	global $CODETHEME;
	if ($theme ==''){ $theme = $CODETHEME; }
	?>
	</TEXTAREA>
	<SCRIPT>
		var textarea_editor = document.getElementById("codeEdit<?php
		echo $counter; ?>");
			this.editor      = CodeMirror.fromTextArea(
				textarea_editor, { 
					mode				: '<?php echo $mode;  ?>',
					theme				: '<?php echo $theme; ?>',
					lineNumbers		: true, 
					indentWithTabs	: true, 
					tabSize			: 3, 
					matchBrackets	: true
				}
			);<?php
		if ($height != 0){ ?>
			this.editor.setSize( null, <?php echo $height; ?>);
		<?php 
		} ?>
	</SCRIPT>
	<BR />
	<?php 
}
/**** <?php editBegin(); ?> 					// starts code highlighting ****/
function editBegin(){
	global $counter; 
	global $CODEVIEW_ON; 
	$CODEVIEW_ON = true;
	$counter++;
	?>
	<TEXTAREA ID="codeEdit<?php
		echo $counter; ?>">
	<?php
}

/**** <?php editEnd() ?> 					// ends code highlighting ****/
function editEnd(
						$height = 0,			  // rows, defaults to code length
						$mode   = 'php',  		// syntax(default PHP,HTML5,& CSS. 'clike' = C/C++ 
						$theme  = ''		// color theme.
					){
	global $counter;
	global $CODETHEME;
	if ($theme ==''){ $theme = $CODETHEME; }
	?>
	</TEXTAREA>
	<SCRIPT>
		var textarea_editor = document.getElementById("codeEdit<?php
		echo $counter; ?>");
		this.editor      = CodeMirror.fromTextArea(
			textarea_editor, { 
				mode				: '<?php echo $mode;  ?>',
				theme				: '<?php echo $theme; ?>',
				lineNumbers		: true, 
				indentWithTabs	: true, 
				readOnly			: false,
				tabSize			: 3, 
				matchBrackets	: true
			}
		);<?php
		if ($height != 0){ ?>
			this.editor.setSize( null, <?php echo $height; ?>);
		<?php 
		} ?>
		var editor<?php echo $counter;?> = this.editor;
	</SCRIPT>
	<BUTTON type="button" onclick="ySite.yCodeSave(editor<?php echo $counter; ?>);">
		Click to Save
	</BUTTON>
<?php  
}
// --------- PAGE FUNCTIONS ----------------------------------------------------------
function yHeadMeta($TITLE, $DESC, $AUTHOR, $PAGE_TYPE, $AVATAR ){
?>
	<META name="description" content="<?php echo $DESC; ?>"/>
	<META name="author" content="<?php echo $AUTHOR; ?>">
	<META name="publisher" content="<?php echo SITE_NAME; ?>">
	<meta name="generator" content="yBlog" /> 
	<META property="og:url" content="<?php echo PAGE_URL; ?>"/> 
	<META property="og:type" content="<?php echo $PAGE_TYPE; ?>"/>
	<META property="og:title" content="<?php echo $TITLE ?>"/>
	<META property="og:description" content="<?php echo $DESC; ?> "/>
	<META property="og:image" content="<?php echo $AVATAR; ?>"/> 
	<META name="viewport" content="width=device-width, initial-scale=1.0"/>
	<META charset="utf-8" />
<?php
}
function yCodeViewer($CODETHEME){
	if (!file_exists(SITEURL.'lib/codemirror/code.js')){
		ob_start();
		readfile(SITEURL.'lib/codemirror/codemirror-min.js'); echo ";\n";
		readfile(SITEURL.'lib/codemirror/mode/xml/xml.js'); echo ";\n";
		readfile(SITEURL.'lib/codemirror/mode/javascript/javascript.js'); echo ";\n";
		readfile(SITEURL.'lib/codemirror/mode/css/css.js'); echo ";\n";
		readfile(SITEURL.'lib/codemirror/mode/htmlmixed/htmlmixed.js'); echo ";\n";
		readfile(SITEURL.'lib/codemirror/mode/clike/clike.js'); echo ";\n";
		readfile(SITEURL.'lib/codemirror/mode/php/php.js'); echo "\n";
		$s = ob_get_clean();
		require_once 'codemirror/jsMinify.php';
		$s = \JShrink\Minifier::minify($s);
		$f = fopen(SITE_ROOT."lib/codemirror/code.js", 'w');
		fwrite($f, $s);
		fclose($f);
		ob_start();
		readfile(SITEURL.'lib/codemirror/codemirror-min.css');  echo "\n";
		readfile(SITEURL.'lib/codemirror/theme/'. $CODETHEME. '.css'); echo "\n";
		$s = ob_get_clean();
		yMinimize($s);
		$f = fopen(SITE_ROOT.'lib/codemirror/code.css', 'w');
		fwrite($f, $s);
		fclose($f);
	}
	$s  = "\t<SCRIPT SRC=\"". SITEURL ."lib/codemirror/code.js\"></SCRIPT>";
	$s .= "\n\t<LINK HREF=\"".  SITEURL ."lib/codemirror/code.css\" REL=\"stylesheet\"/>\n";
	echo $s;
}
function	yMeta($title, $author, $page_type, $page_url, $modified, $avatar){	
?>
		<META itemprop="headline" content="<?php echo $title; ?>">
		<META itemprop="url" content="<?php echo $page_url; ?>">
		<META itemprop="author" content="<?php echo $author; ?>" > 
		<META itemprop="mainEntityOfPage" content="<?php echo $page_type; ?>">
		<META itemprop="inLanguage" content="en-US" />
		<META itemprop="datePublished" content="<?php echo date("Y-m-d", $modified); ?>"/>
		<META itemprop="dateModified" content="<?php echo date("Y-m-d", $modified); ?>"/>
		<SPAN itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
			<META itemprop="url" content="<?php echo $avatar; ?>"/>
		</SPAN>
  			<SPAN itemprop="publisher" itemscope itemtype="http://schema.org/Organization">
			<META itemprop="name" content="<?php echo SITE_NAME; ?>">
			<META itemprop="url" content="<?php echo SITEURL; ?>">
			<SPAN itemprop="logo" itemscope itemtype="http://schema.org/ImageObject">
				<META itemprop="url" content="<?php echo SITEURL.SITE_LOGO; ?>">
				<META itemprop="width" content="300">
  				<META itemprop="height" content="200">
 			</SPAN>
		</SPAN>
<?php
}
function yAnalytics(){
if(ANALYTICS !== "0"){?>
	<SCRIPT ASYNC SRC="https://www.googletagmanager.com/gtag/js?id=<?php 
		echo ANALYTICS; ?>"></SCRIPT>
	<SCRIPT>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());
	  gtag('config', '<?php echo ANALYTICS ?>');
	</SCRIPT>
<?php }
}
function yAdobe(){
?>
		<SCRIPT DEFER SRC="https://documentcloud.adobe.com/view-sdk/main.js">
		</SCRIPT>
<?php 
}
function ySiteMenu($fileDir, $pageDir){
	$files   = glob($fileDir."*.php");
	$j       = 0;
	for($i = 0; $i < 200; $i++ ){ 
		foreach($files as $file){
			$f = basename($file);
			if ($f == 'index.php'){ continue; }
			unset($MENU_ORDER);
			ob_start();
			include $fileDir.$f;
			$x = ob_get_clean();
			if (isset($MENU_ORDER)){
				if ($MENU_ORDER == $i && $MENU_ORDER != 0){ 
					$j++; 
?>					<A HREF="<?php echo $pageDir.$f;?>"><?php echo $TITLE;?></A>
<?php
					if ($j > count($files) +1){ break(2); }
				}
			}
		}
	}
}
function yBlogList($blogDir, $thisFile){
	$x = SITE_ROOT.$blogDir."*.php";
	$files = glob($x);
	$j = 0;
	?>
	<TABLE>
	<?php
	for ($i = 0; $i < 100; $i++ ){ 
		foreach($files as $file){
			$f = basename($file);
			if ($f == $thisFile || $f == 'index.php'){
				continue; 
			}
			if(isset($TITLE))			{ unset($TITLE)		;}
			if(isset($DESC))			{ unset($DESC)			;}
			if(isset($AUTHOR))		{ unset($AUTHOR)		;}
			if(isset($PAGE_TYPE))	{ unset($PAGE_TYPE)	;}
			if(isset($AVATAR))		{ unset($AVATAR)		;}
			if(isset($MENU_ORDER))	{ unset($MENU_ORDER)	;}
			ob_start();
			include SITE_ROOT.$blogDir.$f;
			include 'config.php';
			$x = ob_get_clean();
				if(!isset($TITLE     )){$TITLE      = SITE_NAME		;}
				if(!isset($DESC      )){$DESC		   = SITE_DESC		;}
				if(!isset($AUTHOR    )){$AUTHOR     = SITE_AUTHOR	;}
				if(!isset($PAGE_TYPE )){$PAGE_TYPE  = 'Article'		;}
				if(!isset($AVATAR)){	$AVATAR = SHARING_LOGO;
				} else {					$AVATAR = SITEURL.$blogDir.$AVATAR	;}
				if (isset($MENU_ORDER) && $MENU_ORDER == $i){ 
				$j++;
				$pageUrl =  PAGE_DIR.$blogDir.$f;
				$modified = filemtime(SITE_ROOT.$blogDir.$f); 
?>
				<TR><TD>
					<BLOCKQUOTE>
						<H3 itemscope itemtype="http://schema.org/Blog"><?php 
						yMeta($TITLE, $AUTHOR, $PAGE_TYPE, $pageUrl, $modified, $AVATAR);?>
							<A HREF="<?php echo $pageUrl ?>"><?php 
						echo $TITLE;?></A>
						</H3>
					</BLOCKQUOTE>
				</TD><TD>
					<h5><span data-nosnippet><?php echo $DESC;?></span></h5>
				</TD></TR>		
				<?php
				if ($j >= count($files)){ 
					break(2);
				}
			}
		}
	}
?>	</TABLE>
<?php
}
function yMinimize(&$src){
	$blocks = preg_split(
		'~(<\/?(PRE|TEXTAREA)[^>]*>)~i',
		$src,
		NULL,
		PREG_SPLIT_DELIM_CAPTURE
	);
	$src="";
	foreach($blocks as $i => $block):
		if ($i%6==3) $src.= $block;
		elseif ($i%6==2 || $i%6==5) { }
		else {
			// remove double-slash comments
			$block = preg_replace('/\n(\s+)?\/\/[^\n]*/', '', $block);
			// remove /* */ comments
			$block = preg_replace('/\/\*[^\/]*\*\//', '', $block);
			// remove whitespace
 			$src .= preg_replace(
				array('~>\s+<~u','~\s\s+~u','~\s<~'),
				array('><',' ','<'),
				str_replace(array("\t","\n"),' ', $block)
			);
		}
	endforeach;
}
function yTiny() {
	 //$content = file_get_contents(SITEURL.'textEditor.php');
?>
	<script src="<?php echo SITEURL;?>lib/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
    tinymce.init({
        selector: "textarea",
        themes: "modern",   
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table paste"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"   
    });
    </script>
<?php
}
function yToc($tag = 'H2', $class='right', $note = ""){
	$yCnt = 0;  
	$html = file_get_contents(FILEPATH); 
	$regex = '#<\s*?'.$tag.'\b[^>]*>(.*?)</'.$tag.'\b[^>]*>#is';
	preg_match_all($regex, $html, $tags); // tags[1] contains tag text
	if(count($tags[1]) < 2) return;
	$s = "\t<DL class=".$class."\">\n";
	if (strcasecmp($tag, 'h2') == 0)
			$s	.= "\t\t<DT>On this Page:</DT>\n";
	else 	$s .= "\t\t<DT>In this Section:</DT>\n";
	foreach ($tags[1] as $w){	
		$yCnt++;
		$y	 = 'y'.strtoupper($tag).'_'.$yCnt.'_';
		$y .= preg_replace("/[\s+ . ']/", "", htmlspecialchars($w));
		$s	.= "\t\t<DD><A HREF=\"#". $y .'" onclick="ySite.yHash(\'#' .$y . '\',1,event);">'; 
		$s .= $w ."</A></DD>\n";
	}
	if ($note !="") $s .= "\t\t\t<DD class='help'>". $note ."</DD>\n";
	$s .= "\t</DL>";
	echo $s;
}
function yAnchors(&$body, $tag = 'H2'){
	$yCnt = 0;
	$body = preg_replace_callback(
		'#<\s*?'.$tag.'\b[^>]*>(.*?)</'.$tag.'\b[^>]*>#is',
		function($matches) use($tag, &$yCnt){
			static $yCnt = 0;  
			$yCnt ++;
			$s  = "\n\t<DIV id=\"y".strtoupper($tag).'_'.$yCnt.'_';
			$s .= preg_replace("/[\s+ . ']/", "", htmlspecialchars($matches[1]));
			$s .= "\" class=\"anchor\"></DIV>\n";
			return $s.$matches[0];
		}, 
		$body
	);
}
function yThumb(&$body, $page_desc){
	$body = preg_replace_callback(
		'/<img[^>]+>/i',
		function($matches) use ($page_desc){
			$srcUrl = ""; $alt= ""; $h = 0; $w = 0; $m="<IMG"; 
			$class=""; $style=""; $imgattrs = array();
			preg_match_all('/(\w+)=[\'"]([^\'"]*)/', 
				$matches[0], $imgattrs, PREG_SET_ORDER);
			foreach($imgattrs as $attrs){ // find attributes in array
				if(strpos($attrs[2],'base64')!= false) return $matches[0];
				if(strcasecmp($attrs[1], 'src') == 0){
					$srcUrl = $attrs[2]; // todo: dotted relative URLs
					$x = SITE_ROOT.PAGE_DIR_REL.$srcUrl;
					$m .= ' DATA-SRC="'.$srcUrl.'"';
				} else if(strcasecmp($attrs[1], 'alt') == 0){
					$alt = $attrs[2]; 
					$m .= ' ALT="'.$attrs[2].'"';
				} else if(strcasecmp($attrs[1], 'class') == 0){
					$class = ' CLASS="'.$attrs[2].'"'; 
				} else if (strcasecmp($attrs[1], 'style') == 0){
					$style = $attrs[2];
					$props = preg_split("/;+/", $attrs[2]);
					foreach ($props as $prop) { 
						$styles = preg_split("/:+/", $prop);
						if(strcasecmp(trim($styles[0]),'width') == 0)
								$w = substr(trim($styles[1]), 0, -2); 
						else if(strcasecmp(trim($styles[0]),'height') == 0)
								$h = substr(trim($styles[1]), 0, -2); 
					}//todo: check that w & h are not other units
				} else{ //accumulate other attributes
					$m .= ' '.$attrs[1].'="'.$attrs[2].'"';
				}
			}
			if ($srcUrl=="") return;
			if ($alt=="") $alt = $page_desc;
			list($width, $height, $type, $extra) = getimagesize($x);
			if($w>0 && $h>0){ // style string ok
			}else if($w>0){ // add height. todo: support other units  than px
				$h  = round($w * $height / $width);
				$m .= ' STYLE="height:'.$h.'px;'.$style.'"';
			}else if($h>0){ // add width
				$w  = round($h * $width / $height); 
				$m .= ' STYLE="width:'.$w.'px;'.$style.'"';
			}else { // default width 300px
				$w  = 300;
				$h  = round(300 * $height / $width);
				$m .= ' STYLE="height:'.$h.'px;width:'.$w.'px;'.$style.'"';
			} // built HTML string with microdata
			$f = pathinfo($srcUrl, PATHINFO_FILENAME).'_'.$w.'_'.$h.'.jpg';
			$s = "\t<FIGURE".$class." itemscope "; 
			$s .="itemtype=\"http://schema.org/ImageObject\">\n";
			$s .="\t\t". $m ." SRC=\"img/thumbs/".$f."\">\n";
			$s .="\t\t<LINK itemprop=\"image\" content=\"".$srcUrl."\">\n";
			$s .="\t\t<META itemprop=\"caption\" content=\"".$alt."\">\n";
			$s .="\t\t<FIGCAPTION>".$alt."</FIGCAPTION>\n";
			$s .="\t</FIGURE>\n";
			$d = SITE_ROOT.PAGE_DIR_REL.'img/thumbs'; // thumb directory
			if (!file_exists($d)){ mkdir($d, 0755, true); }
			$i = $d.'/'.$f; // thumb fiLepath
			if (!file_exists($i)) {  // write thumb
				$type = exif_imagetype($x);
				switch ($type){
					case IMAGETYPE_JPEG: $image = imagecreatefromjpeg($x); break;
					case IMAGETYPE_PNG: $image = imagecreatefrompng($x); break;
					case IMAGETYPE_GIF: $image = imagecreatefromgif($x); break;
					default:	return;
				}
				$thumb = imagecreatetruecolor($w, $h);
				imageinterlace($thumb, true);
				imagecopyresampled($thumb, $image, 0,0,0,0, $w, $h, $width, $height);
				imagejpeg($thumb, $i, 50);
				imagedestroy($thumb);
			}// put new string in BODY
			return $s;
		}, 
		$body
	);
}
//--------------------- UTILITIES --------------------------------------------------------
// formatBytes() - Human-readable filesize
function formatBytes($size, $precision = 1){
	$base = log($size, 1024);
	$suffixes = array('', 'KB', 'MB', 'GB', 'TB');   
	return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
} 
// yFileWrite()
function yFilewrite($f, $s){
	$h = fopen($f, "w") or die("Unable to open ".$f); //"r+" to append
	fwrite($h, $s);
	fclose($h);
} 
function debug(){
	global $debug;
	if($debug){ ?>
		FILEPATH is <?php echo FILEPATH; ?><BR>
		FILENAME is <?php echo FILENAME; ?><BR>
		FILE_DIR is <?php echo FILE_DIR; ?><BR>
		PAGE_DIR is <?php echo PAGE_DIR; ?><BR>
		SITEURL is  <?php echo SITEURL; ?><BR>
		PAGE_TEST is <?php echo PAGE_TEST; ?><BR>
		PAGE_URL is <?php echo PAGE_URL; ?><BR>
		PAGE_DIR_REL is <?php echo PAGE_DIR_REL; ?><BR>
		<?php  echo '<pre>$_SESSION variables: ';
		print_r($_SESSION);
		echo '</pre>';
	}
}
?>