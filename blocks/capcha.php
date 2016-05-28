<?php
	session_start();
	$rand = mt_rand(1000, 9999);
	$_SESSION["rand"] = $rand;
	$im = imagecreatetruecolor(110, 60);
	$c = imagecolorallocate($im, 255, 255, 255);
	imageTtfText($im, 35, -10, 20, 40, $c, "../fonts/cap.ttf", $rand);
	header("Content-type: image/png");
	imagePng($im);
	imagedestroy($im);
?>