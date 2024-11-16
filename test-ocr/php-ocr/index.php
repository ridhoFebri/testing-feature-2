<?php
date_default_timezone_set('Asia/Jakarta');
require_once 'vendor/autoload.php';

use Ocr\Core\OCR; // Sesuaikan dengan namespace yang digunakan oleh ocr/core

$ocr = new OCR();
$text = $ocr->recognize('path/to/image.png'); // Sesuaikan metode dan path gambar

echo "Hasil OCR: ";
echo $text;