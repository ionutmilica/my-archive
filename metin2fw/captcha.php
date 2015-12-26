<?php

session_start();
session_name('metin2fw');
	
function generateCode($characters) 
{
	$possible = '23456789bcdfghjkmnpqrstvwxyz';
	$code = '';
	$i = 0;
	while ($i < $characters) { 
		$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
		$i++;
	}
	return $code;
}

function print_image($code, $width = 120, $height= 40, $characters = 6) 
{
	$font_path = __DIR__ . '/monofont.ttf';
	$font_size = $height * 0.75;
	$image = @imagecreate($width, $height) or die('Cannot initialize new GD image stream');

	$background_color = imagecolorallocate($image, 255, 255, 255);
	$text_color = imagecolorallocate($image, 20, 40, 100);
	$noise_color = imagecolorallocate($image, 225, 160, 11);

	for ($i = 0; $i < ($width * $height) / 3; $i++) 
	{
		imagefilledellipse($image, mt_rand(0,$width), mt_rand(0,$height), 1, 1, $noise_color);
	}

	$textbox = imagettfbbox($font_size, 0, $font_path, $code) or die('Error in imagettfbbox function');
	$x = ($width - $textbox[4]) / 2;
	$y = ($height - $textbox[5]) / 2;
	
	imagettftext($image, $font_size, 0, $x, $y, $text_color, $font_path , $code) or die('Error in imagettftext function');
	
	header('Content-Type: image/jpeg');
	imagejpeg($image);
	imagedestroy($image);
	exit;
}

$width = isset($_GET['width']) ? (int) $_GET['width'] : 253;
$height = isset($_GET['height']) ? (int) $_GET['height'] : 60;
$characters = isset($_GET['characters']) && $_GET['characters'] > 1 ? (int) $_GET['characters'] : 6;

$_SESSION['security_code'] = generateCode($characters);
print_image($_SESSION['security_code'], $width, $height, $characters);