<?php
date_default_timezone_set('Asia/Jakarta');
// phpinfo();
// exit;

require_once 'vendor/autoload.php';

use thiagoalessio\TesseractOCR\TesseractOCR;

// Tentukan path Tesseract di sini
$tesseractPath = 'C:\ProgramData\chocolatey\lib\capture2text\tools\Capture2Text\Utils\tesseract\tesseract.exe'; // sesuaikan path ini sesuai dengan lokasi Tesseract di sistem Anda

$result = (new TesseractOCR('ridho.jpeg'))
    ->executable($tesseractPath) // arahkan ke executable Tesseract
    ->lang('ind')
    ->psm(6) // Menambahkan Page Segmentation Mode untuk meningkatkan akurasi
    ->run();
    echo $result;