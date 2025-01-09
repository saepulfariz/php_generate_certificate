<?php
include 'functions.php';


$im = imagecreatefrompng(__DIR__ . '/template.jpg');
$black = imagecolorallocate($im, 0, 0, 0);
// $font = __DIR__ . 'fonts/arial.ttf';
$font = 'fonts/arial.ttf';

$font_handwrite = 'fonts/skrine/Skrine.otf';

$font_digital = 'fonts/digital-display/Digital Display.ttf';

// $img = imagecreatefromjpeg("img.jpg");
$w = imagesx($im);
$h = imagesy($im);

// var_dump($w);
// var_dump($h);
// die;

$data = [
    'name' => 'Saepul Hidayat',
    'cource' => '{ Kang Rebahan }',
    'date' => '2024-08-27',
];

// imagettftext($im, 50, 0, 200, 200, $black, $font, $data['name']);
// imagettftext($im, 30, 0, 200, 300, $black, $font, $data['course']);
// imagettftext($im, 20, 0, 200, 400, $black, $font, $data['date']);
// imagettftext($im, 50, 0, 400, 300, $black, $font, $data['name']);

// imagettftext($im, 100, 0, 300, 350, $black, $font_handwrite, $data['name']);
// imagettftext($im, 20, 0, 500, 400, $black, $font, $data['cource']);
// imagettftext($im, 20, 0, 540, 450, $black, $font, $data['date']);
// imagettftext($im, 20, 0, 540, 450, $black, $font_digital, $data['date']);

centerTextHorizontal($im, 350, 100, $font_handwrite, $black, $data['name']);
centerTextHorizontal($im, 400, 20, $font, $black, $data['cource']);
centerTextHorizontal($im, 450, 20, $font_digital, $black, $data['date']);


include "phpqrcode/qrlib.php";

//set it to writable location, a place for temp generated PNG files
$PNG_TEMP_DIR = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR;

//html PNG location prefix
$PNG_WEB_DIR = 'temp/';

//ofcourse we need rights to create temp dir
if (!file_exists($PNG_TEMP_DIR))
    mkdir($PNG_TEMP_DIR);


$filename = $PNG_TEMP_DIR . 'test.png';

// isi qrcode yang ingin dibuat. akan muncul saat di scan
$isi = 'https://www.malasngoding.com';

// perintah untuk membuat qrcode dan menampilkannya secara langsung dengan format .PNG

// 'L','M','Q','H' level
// 1-10 size
QRcode::png($isi, $filename, 'L', 3);

$src = imagecreatefrompng($filename);

$w = imagesx($src);
$h = imagesy($src);

// Copy and merge
// pake ukuran ini ke potong
// imagecopymerge($im, $src, 10, 10, 0, 0, 100, 47, 75);

// 75 opacity
imagecopymerge($im, $src, 10, 10, 0, 0, $w, $h, 75);

// Output as PNG
header('Content-Type: image/png');
imagepng($im);

// header("Content-type: image/jpeg");
// imagejpeg($im);
imagedestroy($src);
imagedestroy($im);
