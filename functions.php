<?php


function centerTextHorizontal($image, $y, $font_size, $font_style, $color, $text)
{
  // Teks yang ingin ditulis
  // $text = 'We Are Wating You In';

  // Menghitung ukuran bounding box teks
  $bbox = imagettfbbox($font_size, 0, $font_style, $text);

  // Menghitung lebar teks
  $text_width = $bbox[2] - $bbox[0];

  // Menghitung posisi X untuk membuat teks di tengah
  $image_width = imagesx($image);
  $x = ($image_width - $text_width) / 2;

  // Menghitung posisi Y untuk membuat teks di posisi vertikal yang diinginkan (misal: 200px dari atas)
  // $y = 200;

  // Menambahkan teks ke gambar
  return imagettftext($image, $font_size, 0, $x, $y, $color, $font_style, $text);
}

function word_limiter($str, $limit = 10)
{
  if (stripos($str, " ")) {
    $ex_str = explode(" ", $str);
    if (count($ex_str) > $limit) {
      $str_s  = '';
      for ($i = 0; $i < $limit; $i++) {
        $str_s .= $ex_str[$i] . " ";
      }
      return $str_s . "&hellip;";
    } else {
      return $str;
    }
  } else {
    return $str;
  }
}