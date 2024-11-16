<?php

require 'vendor/autoload.php';
// Mulai pengukuran waktu
$startTime = microtime(true);
ini_set('memory_limit', '4056M');
set_time_limit(2000);
// Konfigurasi database
$host = 'localhost'; // ganti sesuai konfigurasi
$dbname = 'test_databases';
$username = 'root'; // ganti sesuai konfigurasi
$password = ''; // ganti sesuai konfigurasi

try {
    // Membuat koneksi PDO ke database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Query untuk mengambil data produk dengan status aktif
    $stmt = $pdo->prepare("SELECT id, nama, jumlah, harga FROM data_produk WHERE status = 'aktif' LIMIT 100");
    $stmt->execute();
    
    // Mengambil semua data produk
    $data_produk = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Membuat instance mPDF
    $mpdf = new \Mpdf\Mpdf([
        'pagenumPrefix' => 'Page number ',
        'pagenumSuffix' => ' - ',
        'nbpgPrefix' => ' out of ',
        'nbpgSuffix' => ' pages'
    ]);
    $mpdf->SetHeader('{PAGENO}{nbpg}');

    // Memulai buffer HTML untuk output PDF
    $html = '<h1>Data Produk Aktif</h1>';
    $html .= '<table border="1" cellpadding="10" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>';
    
    // Loop melalui data produk dan menambahkannya ke tabel HTML secara bertahap
    foreach ($data_produk as $produk) {
        $html .= '<tr>
                    <td>' . $produk['id'] . '</td>
                    <td>' . $produk['nama'] . '</td>
                    <td>' . $produk['jumlah'] . '</td>
                    <td>' . $produk['harga'] . '</td>
                  </tr>';
        
        // Cek jika ukuran memori terlalu besar, output secara bertahap
        if (strlen($html) > 100000) { // Treshold untuk memori besar
            $mpdf->WriteHTML($html);
            $html = ''; // Reset buffer
        }
    }

    $html .= '</tbody></table>';
    
    // Menulis sisa HTML ke mPDF dan menghasilkan PDF
    $mpdf->WriteHTML($html);
    $mpdf->Output();
// Selesai pengukuran waktu
$endTime = microtime(true);

// Hitung durasi
$executionTime = $endTime - $startTime;

// Simpan ke log file
file_put_contents('execution_time.log', "Waktu eksekusi: " . $executionTime . " detik", FILE_APPEND);
} catch (PDOException $e) {
    echo "Koneksi atau query gagal: " . $e->getMessage();
}
