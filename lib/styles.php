<?php
//    header("Content-type: text/css");
//	require('../config.php');
?>	<style>
		@media only screen {
<?php 
	switch($STYLES){
		case 'blue': ?>
			:root{
				--fg0:#fff; /*most text*/
				--fg1:#ff6; /*headings*/
				--fg2:#ffc; /*code, details */
				--lnk:#cf6; /* all clickable elements */
				--dec:underline; /* underline for anchors on hover */
				--cur:#936; /* current menu item */
				--hov:<?php echo $var_nav;?>; /* hover, nav, and news */
				--foc:#F69; /* focus on any clickable element */
				--bg0:linear-gradient(180deg,#003 0%,#109 10%,#99c 100%);/* page bckgrnd */
				--bg1:#369; /* article bckgrnd */
				--bg2:#285888; /* menu and form bckgrnd */
				--bg3:#416; /* js function bckgrnd */
				--bg4:linear-gradient(45deg,#147,#416); /* toc and nested blocks */
				--drk:#333; /* dark background for welcome etc*/
				--drkr:#222; /* dark background for welcome etc*/
				--brd1w:2px; 
				--brd1s:outset; 
				--brd1:#693; 
				--brd1w:2px; 
				--brd2s:outset; 
				--brd2:#999 #222 #333 #999; 
				--brd3w:2px; 
				--brd3s:outset; 
				--brd3:#999 #222 #333 #999; 
				--rad:12px; /* radius of box curved corners */
				--rad2:20px; /* radius of newx box corners */
				--shdw:15px 15px 23px -1px rgba(0,0,0,0.75); /* box shadow */
				--shd2:2px 2px 4px #000; /* text shadow */
			}<?php 
	break;
	case 'boxed': ?>
		:root{
		}<?php 
	break;
	case 'plain': ?>
		:root{
			--lnk:#00f; 
			--dec:underline; 
			--hov:#0ff;
			--foc:#ffe; 
			--nav: #ffd;
			--brd1w:3px; 
			--brd1s:outset; 
			--brd1:transparent transparent transparent #eee; 
			--brd1w:3px; 
			--brd2s:double; 
			--brd2:#888 transparent; 
			--brd3w:3px; 
			--brd3s:solid; 
			--brd3:#ccc transparent; 
			}
<?php 
	break;
} 
?>
		a,button,form.download>input,figure{transition:.5s}
		a,button,form.download>input,figure,nav a,.yClick{color:var(--lnk);text-decoration:none}
		a.active,#yLogo.active{background-color:var(--cur);text-decoration:none!important}
		a,article,blockquote,button,dl,figure,footer,form.download>input,main,section,table,.yClick{
			-moz-border-radius:var(--rad);-webkit-border-radius:var(--rad);border-radius:var(--rad);
			box-shadow:var(--shdw);box-sizing:border-box;display:block;overflow:hidden}
		a,button,figure,form.download>input,.yClick{border-color:var(--brd1);border-style:var(--brd1s);
			border-width:var(--brd1w)}
		article,blockquote{border-color:var(--brd2);border-style:var(--brd2s);
			border-width:var(--brd2w)} 
		dl,footer,main,section,table{border-color:var(--brd3);border-style:var(--brd3s);
			border-width:var(--brd3w)} 
		article,blockquote,main,section{background:var(--bg1);box-sizing:border-box}
		article,main,section{height:100%;margin:0 auto;width:100%;min-height:700px;padding:8px}
		article blockquote,main blockquote,section blockquote{background:var(--bg4);margin:12px;text-align:left}
		a:hover,button:hover,form.download>input:hover,.yClick:hover,#yLogo:hover{
			background-color:var(--hov);cursor:pointer;text-decoration:var(--dec);transition:.7s}
		a.active:hover,#yLogo.active:hover{background-color:var(--cur)!important;
			cursor:default!important;text-decoration:none!important}
		a:focus,button:focus,form.download>input:focus,.yClick:focus,#yLogo:focus{
			color:var(--foc);cursor:pointer;outline:0;text-decoration:var(--dec)}
		a:active,blockquote:active,formform.download>input:active,.yClick:active,#yLogo:active{
			color:var(--act);cursor:wait;text-decoration:var(--dec)}
		aside{font-size:12px;line-height:18px}
		blockquote{font:700 13px/20px 'Arial','Helvetica','sans-serif';margin:4px;padding:4px 8px;
			quotes:none;text-align:center}
		blockquote a,button,form.download>input{background:var(--bg2);display:block;margin:8px auto;padding:0;
			text-align:center}
		button,input{padding:8px}
		body{background:var(--bg0);height:100%;overflow:hidden;overflow-y:auto;z-index:2}
		body,html{box-sizing:border-box;color:var(--fg0);margin:0;padding:0}
		b,h1,h2,h3,h4{font-family:'Arial Black',arial,sans-serif;font-weight:700}
		code,details{color:var(--fg2);font-family:'Lucida Sans','Lucida Grande',sans-serif}
		br{clear:both}
		caption,figcaption{display:none}
		code{word-wrap:break-word}
		dd{clear:both;font:13px/18px arial,sans-serif;margin:4px 0 12px 8px;max-width:350px;
			padding:4px 0;text-align:center}
		dd a{background:var(--bg2);padding:2px 8px}
		dd.help{font-size:11px;font-weight:100;padding-left:4px}
		details{margin:8px 8px 0 0}
		details,summary,.note{font-size:12px;line-height:24px}
		div.anchor{clear:both;height:0;position:relative;visibility:hidden}
		div.CodeMirror{height:auto}
		div.yReader{box-sizing:border-box;height:500px;margin:8px auto;max-width:90%;min-width:300px;
			padding:0;text-align:center;width:720px}
		div.ySnow{height:20px;position:fixed;width:20px;z-index:-1}
		div.yFlex{display:flex;flex-wrap:nowrap}
		dl{background:var(--bg4);clear:right;font-family:arial,sans-serif;font-weight:700;
			margin:4px -4px 16px 12px;overflow:hidden;padding:8px 4px 0}
		dt{clear:none;float:right;margin:0;padding:4px 8px 8px 0}
		dt,pre{font-size:13px;line-height:24px}
		em{font-style:oblique;font-weight:700}
		figure{background-color:var(--hov);display:block;margin:8px auto;padding:4px}
		figure:hover{cursor:url(<?php echo SITEURL; ?>lib/img/magnify.png),auto}
		figure:hover,#yLogo:hover{background-color:var(--brd1);border-color:var(--brd2)}
		footer{height:100%;margin:0 auto 36px;max-width:750px;padding:0}
		footer>table{margin:0}
		form,#yMenuMin,#yMnuMax{box-sizing:border-box}
		form.download>input{background-color:--var(bg3);box-sizing:border-box;clear:none;
			font:13px/18px arial,sans-serif;margin:16px auto;width:315px;max-width:90%;
			padding:8px;text-align:center}
		h1,h2,h3{color:var(--fg1);letter-spacing:2px;text-shadow:var(--shd2)}
		h1{font-size:26px;line-height:33px;padding:8px 0 0}
		h1{float:left;text-align:center}
		h2{border-top:1px solid;clear:left;margin:2px -8px 8px;padding:4px 8px 8px}
		h2:first-of-type{clear:both}
		h2,caption,figcaption{font-size:18px;line-height:23px}
		h3,h4{clear:left;font-size:16px;line-height:21px;margin:8px;padding:0}
		h3.desc{clear:none;max-width:300px;text-align:center}
		h4{text-shadow:2px 2px 4px #000}
		h4,h5,h6{color:#fff;letter-spacing:1px}
		h5,h6{color:var(--fg1);font:700 13px/18px arial,sans-serif;margin:8px;padding:0}
		h6{font-style:oblique;font-weight:400}
		li,p{font:13px/18px Cambria,Georgia,Times,'Times New Roman',serif;font-size:12px;
			letter-spacing:.75px;margin:0 0 8px;word-spacing:2px}
		header{box-sizing:border-box;position:fixed;text-align:center;top:0;width:100%;z-index:10}
		hr{clear:left;padding:8px 0;color:var(--fg2)}
		html{-moz-osx-font-smoothing:grayscale;-webkit-font-smoothing:antialiased}
		i{font-style:oblique}
		iframe{display:block;float:right}
		img{display:block;margin:0;padding:0}
		label{display:block}
		li ol,li ul,pre{margin:8px}
		nav{-moz-border-radius-bottomleft:var(--rad2);-moz-border-radius-bottomright:var(--rad2);
		-webkit-border-bottom-left-radius:var(--rad2);-webkit-border-bottom-right-radius:var(--rad2);
		background-color:transparent;border-bottom-right-radius:var(--rad2);margin:0 auto;
		max-width:750px;overflow:hidden;padding:0;text-align:right}
		nav a{background-color:var(--bg2)}
		nav a,.yClick{box-sizing:border-box;display:inline-block;
			font-family:'Arial',sans-serif;font-weight:400;margin:0;padding:12px 4px}
		object{display:block;margin:8px auto}
		ol,ul{margin:0 12px 0 0;padding-left:24px}
		ol ol,ol ul,ul ol,ul ul{margin:8px 12px 0 0;padding-left:8px}
		p{text-align:justify;text-justify:inter-word}
		p a,li a,td a{background:none;border:none;box-shadow:none;display:inline}
		strong{font-weight:900}
		sub,sup{display:inline-block;margin:0 1.5px;position:relative;vertical-align:baseline}
		sub{top:3px}
		sup{top:-3px}
		section>table tr{display:flex;flex-wrap:wrap;justify-content:center}
		section>table td{box-sizing:border-box;min-width:315px;width:50%}
		section>table td>blockquote{margin:0 0 8px;padding:0}
		section>table td>blockquote>h3{margin:0;padding:0}
		section>table td>blockquote>h3>a{display:block;margin:0;padding:8px}
		table{border-spacing:0;border-width:medium 0;box-sizing:border-box;
			margin:8px 0 8px 8px;padding:0;text-align:left;width:auto}
		table.date{float:right;font-style:italic;margin-top:0}
		table.date td{padding:6px 8px}
		table table{margin:auto 0}
		table h3{margin-top:0}
		tbody,thead,tr{border:0}
		tbody th{font-weight:700}
		td,th{border:0;font-size:11px;line-height:20px;margin:0;padding:12px 8px 0;vertical-align:top}
		textarea{position:relative;width:100%;z-index:5}
		tr:nth-child(1n){background-color:var(--drk)}
		tr:nth-child(2n){background-color:var(--drkr)}
		.center{float:none;margin:8px auto;text-align:center;width:100%}
		.left{float:left;margin:8px}
		.right{float:right;margin:8px}
		.yClick{background-color:var(--bg3);color:var(--lnk)}
		.CodeMirror{margin:16px 8px}
		#yAvatar{clear:left;float:none;margin:12px auto;width:150px}
		#yCookie{background-color:var(--drkr);border-top:1px solid yellow;bottom:0;color:#fff;display:block;left:0;margin:0;padding:0;
			position:fixed;right:0;text-align:center}
		#yCookie>input{display:block;float:right;margin:6px 16px 0}
		#yCookie>label{float:right;clear:none}
		#yCookie>p{float:left;font-size:13px;margin:0;padding:4px 8px}
		#yLogo{background-color:transparent;background-image:url(<?php echo SITEURL.SITE_LOGO; ?>);
			background-repeat:no-repeat;background-size:100%;border-color:var(--brd1);border-style:double;
			border-width:3px;float:left;height:46px;margin:0 0 0 4px;padding:0;width:100px}
		#yNews{-moz-border-radius-topleft:var(--rad2);-moz-border-radius-topright:var(--rad2);
			-webkit-border-top-left-radius:var(--rad2);-webkit-border-top-right-radius:var(--rad2);
			background:var(--hov);border-top-left-radius:var(--rad2);border-top-right-radius:var(--rad2);
			box-sizing:border-box;float:none;margin:2px auto 0px;max-width:430px;padding:2px 8px 4px;
			text-align:center;width:100%}
		#ySpacer{height:100%;margin:0 auto 12px;max-width:750px;padding:0}
		#yStars{height:100%;left:0;position:fixed;top:0;width:100%;z-index:-1}
		#yView{background-color:rgba(0,0,0,0.75);
			background-image:url(<?php echo SITEURL; ?>lib/img/loading.gif);background-position:center;
			background-repeat:no-repeat;background-size:100px 80px;box-sizing:border-box;display:none;
			height:100%;left:0;padding:40px 0 0;position:fixed;top:0;width:100%;z-index:100}
		#yView>#yimg{background:none;border:0;border-radius:0;box-shadow:none;height:100%;
			margin:0 auto;max-width:100%;object-fit:contain;padding:0;width:100%}
		#yView>#yimg:hover{cursor:move}
		#yView>#ycell{height:60px;left:0;margin:0;padding:0;position:absolute;top:0;width:100%;z-index:110}
		#ycell>#ycap{clear:none;display:block;font-family:sans-serif;line-height:40px;margin:0;
			overflow:hidden;padding:8px;text-align:left;text-overflow:ellipsis;white-space:nowrap}
		#yView>#ycell>#ynext,#yView>#ycell>#yprev,#yView>#ycell>#yshut{float:left;margin:4px 0 0 8px;width:80px}
		}
		@media screen and (max-width:639px) {
			a,blockquote,p,li{font-size:16px;line-height:22px}
			blockquote.left{float:none;margin:8px auto}
			blockquote.right{float:none;margin:16px auto}
			div.yReader{margin:8px auto;max-height:90%;text-align:center;width:300px}
			div.yFlex{flex-wrap:wrap}
			div.yFlex div{width:100%}
			dl{float:none;margin:8px auto;text-align:center;width:100%}
			dt{float:none;text-align:right}
			iframe,figure,.left,.right{float:none;margin:8px auto;max-width:90%}
			img{margin:8px auto}
			li,ol,p,td,ul{margin-right:0!important}
			p,li,td{clear:both;text-align:left!important}
			h1{font-size:20px;line-height:26px}
			h2,h3{font-size:18px;line-height:24px}
			h4,h5,h6{font-size:16px;line-height:22px}
			section>table td{width:100%!important}
			section>table td:nth-child(2n){text-align:center!important;width:100%}
			td{font-size:14px;line-height:19px}
			#yAvatar{display:none}
		}
		@media screen and (max-width:480px) {
			section>table td{width:100%!important}
			section a,section h5{max-width:315px}
		}
		@media only print {
			figure{clear:left;float:left;margin:0 15px 15px 8px}
			dl,embed,footer,header,iframe,object,#avatar,#yNews,#yView{display:none}
			table.date{display:none;font-style:italic}
		}
	</STYLE> 
