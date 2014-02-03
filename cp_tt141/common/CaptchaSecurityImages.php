<?php
session_start();
ob_start();

class CaptchaSecurityImages {

	var $font = 'DEADA___.TTF';

	function generateCode($characters) 
	{
		
		/* list all possible characters, similar looking characters and vowels have been removed */
		$possible = '23456789PlmOJNiUhbYgVtfCrDxeSXZasQW'; 
		$code = '';
		$i = 0;
		while ($i < $characters) { 
			$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
			$i++;
		}
		
		return $code;
	}

	function CaptchaSecurityImages($width='120',$height='40',$characters='2') {

		$code = $this->generateCode($characters);

		/* font size will be 75% of the image height */
		$font_size = $height * 0.75;
		$image = @imagecreate($width, $height) or die('Cannot Initialize new GD image stream');
		
		/* set the colours */
		$background_color = imagecolorallocate($image, 240,240,240);
		$text_color = imagecolorallocate($image, 162,184,49);
		$noise_color = imagecolorallocate($image,240,240,240);
		
		/* generate random dots in background */
		for( $i=0; $i<($width*$height)/3; $i++ ) {
			imagefilledellipse($image, mt_rand(0,$width), mt_rand(0,$height), 1, 1, $noise_color);
		}
		
		/* generate random lines in background */
		for( $i=0; $i<($width*$height)/150; $i++ ) {
			imageline($image, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), $noise_color);
		}
		
		/* create textbox and add text */
		$textbox = imagettfbbox($font_size, 0, $this->font, $code);
		$x = ($width - $textbox[4])/2;
		$y = ($height - $textbox[5])/2;
		imagettftext($image, $font_size, 0, $x, $y, $text_color, $this->font , $code);
		
		/* output captcha image to browser */
		imagejpeg($image);
		imagedestroy($image);
		$_SESSION['security_code'] = $code;

	}

}



$width = isset($_GET['width']) ? $_GET['width'] : '120';
$height = isset($_GET['height']) ? $_GET['height'] : '40';
$characters = isset($_GET['character']) ? $_GET['character'] : '6';


header('Content-Type: image/jpeg');
$captcha = new CaptchaSecurityImages($width,$height,$characters);

?>
