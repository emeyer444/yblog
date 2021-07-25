<?php 
//download method must be below download form
	if(@$_POST['download']){
		$file = @$_POST['filename'];
		//	$file='cms.zip';
		require('config.php');
		$dload_path=SITE_ROOT.'inc/'.$file;
		if(in_array($_SERVER['SERVER_NAME'],$whitelist)){
			header('Content-Description: File Transfer');
				header("Content-Type: application/zip");
				header('Content-Disposition: attachment; filename="'.$file.'"');
				header('Expires: 0');
				header('Cache-Control: must-revalidate');
				header('Pragma: public');
				header('Content-Length: ' . filesize($dload_path));
				ob_clean();
				readfile($dload_path);
		}
	}
?>