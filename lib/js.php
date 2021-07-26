<?php  
//header("Content-type: application/javascript");
//require('../config.php');
?>
	<SCRIPT>
		var ySite = {
			yCodeSave:function(editor){
			  var x = editor.getValue();
				var blob = new Blob(
					[x], { 
						type: "text/plain;charset=utf-8" 
					}
				);
				saveAs(blob, "dynamic.txt");
			},
			uniqueId:(function() {
			 var id = 0;
			 return function() { return id++; };
			})(),
			id:function(id){
				return document.getElementById(id);
			},
			tags:function(tag){
				return document.getElementsByTagName(tag);
			},
			getYpos:function(e){
				var y = 0;
				while(e){
					y += (e.offsetTop - e.scrollTop + e.clientTop);
					e = e.offsetParent;
				}
				return y;
			},
			yInit:function(){
				if(document.readyState == 'interactive'){
					if (window.location.hash) scroll(0, 0);
						setTimeout(function() {
							 scroll(0, 0);
						}, 1);
					ySite.yCookieInit();
					/* ySite.yToc('H2','yLeader', 'right', "(Click the images for a lightbox slideshow)");*/
					ySite.yNavInit();
					ySite.yScroll();
					ySite.yLightbox();
				}
			},
			yCookieInit:function(){
				var x 		 = document.createElement("div");
				x.id			 = "yCookie";
				var s			 = '<P>This site takes pleasure in cookies to enhance its experience.</P>';
					 s			+= '<input type="checkbox" onclick="ySite.yCookieHide()"/>';
					 s			+= '<label>Accept:</label>';
				x.innerHTML  = s;
				document.body.appendChild(x);
				x = ySite.yCookieGet('Cookies');
				if (x == ""){ 
					document.cookie ='Cookies=0; max-age=31536000; path=/; SameSite=Strict; Secure';
				} else if (x == 1){ 
					ySite.id('yCookie').style.display = 'none';
				}
				x = ySite.yCookieGet('menuState');
				if (x == ""){ 
					ySite.yShow(0);				
					document.cookie ='menuState=1; max-age=31536000; path=/; SameSite=Strict; Secure';
				} else if (x == 0){ 
					ySite.yHide(0); 
				} else if (x == 1){ 
					ySite.yShow(0); 
				}
			},
			yCookieGet:function(name){
				let x = document.cookie;
				x = RegExp(name + "=[^;]+").exec(x);
				x = decodeURIComponent(!!x ? x.toString().replace(/^[^=]+./,"") : "");
				return x;
			},
			yCookieSet:function(name, nVal){ 
				if (name=='Cookies'){
					document.cookie = 'Cookies='  + nVal + '; max-age=31536000; path=/;secure';
				}else if (name=='menuState'){
					document.cookie = 'menuState='+ nVal + '; max-age=31536000; path=/;secure';
				}
			},
			yCookieHide:function(){
				ySite.yCookieSet('Cookies', 1);
				ySite.id('yCookie').style.display = 'none';
			},
			yToc:function(tag, idBefore, pos, note){
				let tags	 = Array.from(ySite.tags(tag));
				const L		= tags.length;
				var s = "";
				if (L < 2)	return;
				if (tag	=== 'H2'){
					s 	 += "<dt>On this Page:</dt>";
				} else {
					s 	 += "<dt>In this Section:</dt>";
				}
				var w, x, y		= 0;
				var yCnt = ySite.uniqueId();
				for (var i		= 0; i < L; i++){	
					w				= tags[i].textContent;
					x				= document.createElement("DIV");
					y				= tags[i].textContent.replace(/\s/g,'').replace(/'/g,'') + '_y' + yCnt;
					x.id			= y;
					x.className = 'anchor';
					x				= tags[i].parentNode.insertBefore(x, tags[i]);
					s			  += '<DD><A HREF="#' + y + '" ';
					s			  += 'onclick="ySite.yHash(\'#' + y + '\',1,event);">'; 
					s			  += w + '</A></DD>';
				}
				if (note != null){
					s += "<dd class='help'>" + note + "</dd>";
				}
				x				= document.createElement("DL");
				x.className = pos;
				x.innerHTML = s;
				y				= ySite.id(idBefore);
				x				= y.parentNode.insertBefore(x, y);
			},
			yNavInit:function(){
				document.getElementById("yBtn").addEventListener("click",		function(){
					ySite.yHash('#top', 1, event);									} );
				document.getElementById("yHideMenu").addEventListener("click",	function(){
					 ySite.yCookieSet('menuState',0);ySite.yHide(1); } );
				document.getElementById("yShowMenu").addEventListener("click",	function(){
					 ySite.yCookieSet('menuState',1);ySite.yShow(1); } );
				var current		= location.href;
				var menuItems  = document.querySelectorAll('nav a');
				var h				= "";
				for (var i = 0, len = menuItems.length; i < len; i++) {
					h = menuItems[i].getAttribute("href");
					if(h === current){
						menuItems[i].className = "active";
						break;
					}
				}
			},
			yHashOnLoad:function(){
				if (window.location.hash){
					ySite.yHash(location.hash, 0, null);			
				}
			},
			yHash:function(h, spd, event){
				var y;
				if (event != null){
					event.preventDefault();
				}
				if (h != '' && h != '#' && h != '#top'){
					y = ySite.id(h.substring(1));
					y = Math.floor(y.getBoundingClientRect().top +window.scrollY);
					ySite.yScroll(spd);
					if (spd==1)scrollTo({ top: y, left: 0, behavior: 'smooth' });
					else scrollTo(y, 0);
					history.pushState("", document.title, location.pathname + h);
				} else {
					ySite.yScroll(spd);
					if (spd==1)scrollTo({ top: 0, left: 0, behavior: 'smooth' });
					else scrollTo(0, 0);
					history.pushState("", document.title, location.pathname);
				}
			},
			yMenuSize:function(x){
				var y = getComputedStyle(ySite.id('yNav')).height;
				if(x==0){
					y = y.substring(0, y.length - 2);
					y = parseInt(y, 10);
					var z = ySite.id("ySpacer");
					z.style.transition = '0s';
					z.style.transform  = 'translate(0,' + y + 'px)';
					var anchors = document.getElementsByClassName('anchor');
					y = -y - 8;
					for (var i = 0; i < anchors.length; i++) {
						anchors[i].style.top = y	+ 'px';
					}
				} else {
					setTimeout(function(){ 
						var y = getComputedStyle(ySite.id('yNav')).height;
						y = y.substring(0, y.length - 2);
						y = parseInt(y, 10);
						var z = ySite.id("ySpacer");
						z.style.transition = '0.5s';
						z.style.transform  = 'translate(0,' + y + 'px)';
						var anchors = document.getElementsByClassName('anchor');
						y = -y - 8;
						for (var i = 0; i < anchors.length; i++) {
							anchors[i].style.top = y	+ 'px';
						}
					 }, 550);
				}
			},
			yShow:function(x){
				ySite.id('yHideMenu').style.display = 'inline-block';
				ySite.id('yShowMenu').style.display = 'none';
				var x = document.querySelectorAll('nav *');
				for(var e = 0; e < x.length; e++){
					if (x[e].className	  == 'yClick' || x[e].id =='yLogo') 
						continue;
					x[e].style.maxHeight 	= '60px';
					x[e].style.maxWidth	 	= '250px';
					x[e].style.borderWidth 	= '2px';
					x[e].style.padding 		= '12px 4px';
					x[e].style.margin			= '0px';
				}
				ySite.yMenuSize(x);
			},
			yHide:function(x){
				ySite.id('yHideMenu').style.display = 'none';
				ySite.id('yShowMenu').style.display = 'inline-block';
				var x = document.querySelectorAll('nav *');
				for(var e = 0; e < x.length; e++){
					if (x[e].className	  == 'yClick' || x[e].id =='yLogo') 
						continue;
					x[e].style.maxHeight 	= '0px';
					x[e].style.maxWidth	 	= '0px';
					x[e].style.borderWidth 	= '0px';
					x[e].style.padding 		= '0px';
					x[e].style.margin			= '-8px';
				}
				ySite.yMenuSize(x);
			},
			yScroll:function(){
				var n	 = document.getElementById('yNav');
				var t	 = document.getElementById('yBtn');
				if (window.scrollY < 30){
					n.style.background	= "transparent";
					t.style.maxHeight		= "0px";
					t.style.maxWidth		= "0px";
					t.style.borderWidth 	= '0px';
					t.style.padding 		= '0px';
				} else {
					n.style.background	= "var(--hov)";
					t.style.maxHeight		= "100px";
					t.style.maxWidth		= "250px";
					t.style.borderWidth 	= '2px';
					t.style.padding 		= '12px 4px';
				}
				ySite.yMenuSize(0);
			},
			yLightbox:function(){
				if(document.readyState != 'interactive') return;
				const IMGS = Array.from(ySite.tags('img'));
				if (IMGS.length == 0) return;
				IMGS.forEach(ySite.imgClick);
				const x = document.createElement("div");
				x.id		  = "yView";
				var s	  	  = '<blockquote id="ycell">';
						s	 += '<div class="yClick" id="yshut">Close</div>';
						s	 += '<div class="yClick" id="yprev">Previous</div>';
						s	 += '<div class="yClick" id="ynext">Next</div>';
						s	 += '<h4 id="ycap"></h4>';
						s	 += '</blockquote>';
						s	 += '<img id="yimg" src="" alt="">';
				x.innerHTML = s;
				document.body.appendChild(x);
			},
			imgClick:function(pic, i, pics){
					pic.addEventListener("click", function(){ 
							ySite.imgShow(pic, i, pics) } );
			},
			imgShow:function(pic, i, pics){
				document.body.style='overflow:hidden';
				ySite.id('yView').style.display = 'block';
				ySite.id('ycap').innerHTML			= pic.getAttribute("alt");
				ySite.id('yimg').src						= pic.getAttribute("data-src");
				pic.onerror && ySite.imgClose();
				const L = pics.length -1;	
				if (L == -1){
					return;
				} else if (L == 0){
					ySite.id('ynext').style.display = "none";		
					ySite.id('yprev').style.display = "none";		
				} else {
					ySite.id('ynext').onclick	= function(){ 
						ySite.imgShow(pics[N], N, pics); };
					ySite.id('yprev').onclick	= function(){ 
						ySite.imgShow(pics[P], P, pics); };
					const N = (i==L)? 0	: i + 1;
					const P = (i==0)? L	: i - 1;
					ySite.id('ynext').onclick	= function(){ 
							ySite.imgShow(pics[N], N, pics); };
					ySite.id('yprev').onclick	= function(){ 
							ySite.imgShow(pics[P], P, pics); };
				}
				ySite.id('yshut').onclick	= function(){ 
						ySite.imgClose();};
				ySite.id('yimg') .onclick	= function(){ 
						ySite.imgClose();};
			},
			imgClose:function(){
				document.body.style='overflow:auto';
				ySite.id('yView').style.display='none';
			},
		
		
			ySnow:function(sNum){
				const h		= window.innerHeight;
				const w		= window.innerWidth;
				const cols	= ['FFF', 'EEE', 'FFC', 'EEC', 'DDF'];
				var snow		= new Array(sNum);
				var sSiz		= new Array(sNum);
				var sX		= new Array(sNum);
				var sY		= new Array(sNum);
				var s			= "<div></div>";
				var x 		= 0;
				for (var i=0; i < sNum; i++){
						s += "<div id='ySnow" + i + "' class='ySnow' ";
						s += "style='color:#" + cols[Math.floor(Math.random()*5)];				
						x = Math.random();
						sSiz[i] = Math.floor(x * x * x * 15 ) + 6;
						s		 += ";font-size:" + sSiz[i];
						sY[i]	  = Math.floor(Math.random() * h);
						s		 += "px;top:"		 + sY[i];
						sX[i]	  = Math.floor(Math.random() * w);
						s		 += "px;left:"		+ sX[i] + "px'>*</div>";
				}
				x				  = document.createElement("div");
				x.id			  = "yStars";
				x.innerHTML   = s;
				document.body.appendChild(x);
				for (var i=0; i < sNum; i++){
						snow[i] = ySite.id("ySnow" + i);
				}
				var self		= this;
				setInterval(function() {self.yAnimate(snow, sSiz, sNum, sX, sY); }, 50);
			},
			yAnimate:function(snow, sSiz, sNum, sX, sY){
				var w			= window.innerWidth;
				var ctr		= w * 0.5;
				var h			= window.innerHeight;
				var spd		= h * 0.00035;
				var e			= "";
				for (var i = 0; i < sNum; i++){
					e = snow[i];
					sY[i] = Math.floor(parseInt(sY[i], 10) + spd * sSiz[i]);
					if ((sX[i] < ctr -350 )|| (sX[i] > ctr +350)){
						if (sY[i] < h ){
							e.style.top	= sY[i] + 'px';
						} else {
							sY[i] = sY[i] - h;
							e.style.top	= sY[i] + 'px';
							sX[i] = Math.floor(Math.random() * w);				
							e.style.left = sX[i] + 'px';				
						}
					} else {
						if (sY[i] < 200) { 
							e.style.top	= sY[i] + 'px';
						} else {
							sY[i] = sY[i] - 200;
							e.style.top	= sY[i] + 'px';
							sX[i] = Math.floor(Math.random() * w);				
							e.style.left = sX[i] + 'px';				
						}
					}
				}
			}
		};
		document.addEventListener("readystatechange",function(){ySite.yInit();});
		 window.addEventListener("load",	function(){ySite.yHashOnLoad();});
		<?php if ($ANIMATE){ ?>
			('ontouchstart' in window || 'onmsgesturechange' in window)? 
		  window.addEventListener("load",	function(){ySite.ySnow(20);	}):
		  window.addEventListener("load",	function(){ySite.ySnow(200);	});
		<?php } ?>
		window.addEventListener("resize",	function(){ySite.yMenuSize(1);	});
		window.addEventListener("scroll",	function(){ySite.yScroll();		});
	</script>
