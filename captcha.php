<?php
require("config.php");

putenv('GDFONTPATH=' . realpath('.'));

$newim = imagecreatetruecolor(100,30);
$white = imagecolorallocate($newim,255,255,255);
$red = imagecolorallocate($newim,0,0,0);
imagefill($newim, 0, 0, $white );

$f = __DIR__."\arial.ttf";
//echo $f;exit;

$rand_text = chr(rand(65,90)).chr(rand(48,57)).chr(rand(65,90)).chr(rand(65,90)).chr(rand(65,90));
$_SESSION['login_code'] = $rand_text;

imagettftext($newim, 15, 0, 10,20, $red, $f, $rand_text);

header("Content-Type: image/jpeg");
imagejpeg($newim);

?>