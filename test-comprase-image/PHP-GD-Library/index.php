<?php
// Load gambar
$image = imagecreatefromjpeg('kk-asli.jpeg');

// Tingkatkan kontras
imagefilter($image, IMG_FILTER_CONTRAST, -50);

// Sesuaikan pencahayaan
imagefilter($image, IMG_FILTER_BRIGHTNESS, 10);

// Hapus border (misalnya, crop 10 pixels dari setiap sisi)
$width = imagesx($image);
$height = imagesy($image);
$cropRect = ['x' => 10, 'y' => 10, 'width' => $width - 20, 'height' => $height - 20];
$image = imagecrop($image, $cropRect);

// Simpan hasil
imagejpeg($image, 'clear_image.jpg');
imagedestroy($image);
?> 