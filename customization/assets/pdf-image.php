<?php
//header("Content-type: image/png");

class BoltImage(){

	public static PDFBadge($user){
		$im    = imagecreatefrompng("images/pdf-card.png");
		$color = imagecolorallocate($im, 0, 0, 0);



		//$font = imageloadfont('fonts/arial.gdf');
		$font = 'fonts/arial.ttf';
		$font_bold = 'fonts/arial-bold.ttf';
		$font_italic = 'fonts/arial-italic.ttf';
		$font_bold_italic = 'fonts/arial-bold-italic.ttf';

		$font_size1 = 16;
		$string1 = $user;
		$text_box1 = imagettfbbox($font_size1,0,$font,$string1);
		$text_width1 = $text_box1[2]-$text_box1[0];
		$px1 = (imagesx($im)/2) - ($text_width1/2);
		imagettftext($im, 16, 0, $px1, 55, $color, $font, $string1);

		$font_size2 = 12;
		$string2 = 'is helping to preserve and promote';
		$text_box2 = imagettfbbox($font_size2,0,$font,$string2);
		$text_width2 = $text_box2[2]-$text_box2[0];
		$px2 = (imagesx($im)/2) - ($text_width2/2);
		imagettftext($im, $font_size2, 0, $px2, 75, $color, $font, $string2);

		$font_size3 = 12;
		$string3 = 'Ontario\'s marine heritage';
		$text_box3 = imagettfbbox($font_size3,0,$font_bold_italic,$string3);
		$text_width3 = $text_box3[2]-$text_box3[0];
		$px3 = (imagesx($im)/2) - ($text_width3/2);
		imagettftext($im, $font_size3, 0, $px3, 95, $color, $font_bold_italic, $string3);

		$font_size4 = 12;
		$string4 = 'by being a member in good standing of';
		$text_box4 = imagettfbbox($font_size4,0,$font,$string4);
		$text_width4 = $text_box4[2]-$text_box4[0];
		$px4 = (imagesx($im)/2) - ($text_width4/2);
		imagettftext($im, $font_size4, 0, $px4, 115, $color, $font, $string4);

		$font_size5 = 16;
		$string5 = 'Save Ontario Shiprecks';
		$text_box5 = imagettfbbox($font_size5,0,$font_bold,$string5);
		$text_width5 = $text_box5[2]-$text_box5[0];
		$px5 = (imagesx($im)/2) - ($text_width5/2);
		imagettftext($im, $font_size5, 0, $px5, 140, $color, $font_bold, $string5);

		$font_size6 = 16;
		$string6 = 'CHAPTER_NAME';
		$text_box6 = imagettfbbox($font_size6,0,$font_bold,$string6);
		$text_width6 = $text_box6[2] - $text_box6[0];
		$px6 = (imagesx($im)/2) - ($text_width6/2);
		imagettftext($im, $font_size6, 0, $px6, 165, $color, $font_bold, $string6);

		$font_size7 = 8;
		$string7 = 'expires Dec. 31, 2020';
		$text_box7 = imagettfbbox($font_size7,0,$font,$string7);
		$text_width7 = $text_box7[2]-$text_box7[0];
		$px7 = (imagesx($im)/2) - ($text_width7/2);
		imagettftext($im, $font_size7, 0, $px7, 195, $color, $font, $string7);

		imagepng($im);

		imagedestroy($im);		
	}

}

