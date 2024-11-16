<?php
// phpinfo();
// exit;
// Cek apakah Imagick tersedia
if (extension_loaded('imagick')) {
    $image = new Imagick('kk-asli.jpeg');

    // Terapkan filter sharpen untuk memperjelas
    $image->sharpenImage(2, 1); // Radius dan sigma

    // Simpan hasil
    $image->writeImage('clear_image.jpg');
    $image->clear();
    $image->destroy();
} else {
    echo "Imagick extension not available.";
}
?>
