<?php
require 'vendor/autoload.php';

ini_set('memory_limit', '4056M');
set_time_limit(2000);

use Dompdf\Dompdf;

// Mulai pengukuran waktu
$startTime = microtime(true);

// Koneksi ke database menggunakan mysqli
$mysqli = new mysqli("localhost", "root", "", "test_databases");

// Cek koneksi
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Query untuk mengambil data produk berdasarkan status aktif
$query = "SELECT id, nama, jumlah, harga FROM data_produk WHERE status = 'aktif' LIMIT 2000";
$result = $mysqli->query($query);

// Cek apakah ada data yang ditemukan
if ($result->num_rows > 0) {
    // Menyiapkan konten HTML untuk Dompdf
    $htmlContent = '
    <h1>Daftar Produk Aktif</h1>
    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>ID Produk</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>';
    
    // Mengisi tabel dengan data dari database
    while ($row = $result->fetch_assoc()) {
        $htmlContent .= "
            <tr>
                <td>{$row['id']}</td>
                <td>{$row['nama']}</td>
                <td>{$row['jumlah']}</td>
                <td>{$row['harga']}</td>
            </tr>";
    }

    $htmlContent .= '
        </tbody>
    </table>';

    // Membuat instance Dompdf
    $dompdf = new Dompdf();

    // Memuat HTML ke Dompdf
    $dompdf->loadHtml($htmlContent);

    // Mengatur ukuran kertas dan orientasi (opsional)
    $dompdf->setPaper('A4', 'portrait');

    // Merender HTML menjadi PDF
    $dompdf->render();

    // Menghasilkan output PDF ke browser
    $dompdf->stream("data_produk.pdf", array("Attachment" => false));
} else {
    echo "Tidak ada produk yang aktif.";
}

// Tutup koneksi database
$mysqli->close();

// Selesai pengukuran waktu
$endTime = microtime(true);

// Hitung durasi
$executionTime = $endTime - $startTime;

// Simpan ke log file
file_put_contents('execution_time.log', "Waktu eksekusi: " . $executionTime . " detik", FILE_APPEND);
?>
