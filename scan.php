<?php
	
	// header("content-type: image/jpeg");
	// $img = imagecreatefromjpeg('uploads/plat.jpg');
	// imagefilter($img, IMG_FILTER_GRAYSCALE); //first, convert to grayscale
	// imagefilter($img, IMG_FILTER_CONTRAST, -1000); //then, apply a full contrast
	// imagejpeg($img);

	// require_once 'tesseract/src/TesseractOCR.php';
	// $tesseract = new TesseractOCR('uploads/test_img.jpg');
	// echo $tesseract->recognize();
	

	$json_data = exec('\openalpr_64\alpr -c id -p id openalpr_64\samples\plat.jpg -j -n 5');
	$data = json_decode($json_data,true);

	print_r($data);

	echo count($data['results']);
	// foreach ($data['results'][0]['candidates'] as $key => $value) {
	// 	echo "<br>".$value['plate'];
	// }
	



