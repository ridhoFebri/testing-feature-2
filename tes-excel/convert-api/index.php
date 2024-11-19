<?php

require 'vendor/autoload.php'; // Pastikan Composer autoload diimpor

use ConvertApi\ConvertApi;

// Set API Key
ConvertApi::setApiCredentials('secret_57nPOvuxYcZBm6RE');

// Konversi file dan menambahkan proteksi
try {
    $result = ConvertApi::convert('protect', [
        'File' => 'Book1.xlsx', // Ganti path file Anda
        'FileName' => 'test',
        'EncryptPassword' => 'ridho',
    ], 'xlsx');

    // Simpan hasil di direktori tujuan
    $result->saveFiles('upload'); // Ganti path direktori tujuan
    echo "File berhasil dikonversi dan disimpan!";
} catch (Exception $e) {
    echo "Terjadi kesalahan: " . $e->getMessage();
}

?>
