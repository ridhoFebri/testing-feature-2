<?php
require 'vendor/autoload.php';

use Google\Cloud\Vision\V1\ImageAnnotatorClient;

// Path ke file credential
putenv('GOOGLE_APPLICATION_CREDENTIALS=my-ocr-project-441808-e0efd8f5d60e.json');

// Inisialisasi client
$imageAnnotator = new ImageAnnotatorClient();

// Path ke gambar yang akan di-scan
$imagePath = '8055.png';

try {
    // Baca file gambar
    $imageData = file_get_contents($imagePath);

    // Kirim permintaan ke Google Vision API
    $response = $imageAnnotator->textDetection($imageData);
    $textAnnotations = $response->getTextAnnotations();

    if ($textAnnotations) {
        echo "Hasil OCR:\n";
        foreach ($textAnnotations as $text) {
            echo $text->getDescription() . PHP_EOL;
        }
    } else {
        echo "Tidak ada teks terdeteksi.\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    $imageAnnotator->close();
}
