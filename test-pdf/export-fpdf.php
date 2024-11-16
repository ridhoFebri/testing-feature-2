<?php

// use Dompdf\Css\Color;

require 'vendor/autoload.php';

// Mulai pengukuran waktu
$startTime = microtime(true);

// Koneksi ke database
$mysqli = new mysqli("localhost", "root", "", "test_databases");

// Cek koneksi
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Query untuk mengambil data produk berdasarkan status aktif
$query = "SELECT id, nama, jumlah, status, harga FROM data_produk WHERE status = 'aktif' LIMIT 2000";
$result = $mysqli->query($query);

// Cek apakah ada data yang ditemukan
if ($result->num_rows > 0) {
    // Membuat instance FPDF
    $pdf = new \FPDF();
    $pdf->AddPage('L');

    // Menambahkan custom font, ukuran, dan warna
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->SetTextColor(0, 0, 0);

    // Header
    $pdf->Cell(0, 10, 'Laporan Penerimaan Kas', 0, 1, 'C');
    $pdf->Ln(-1);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(0, 10, 'Per.Tgl.07-10-2024', 0, 1, 'C');

    $pdf->Ln(1);

    $pdf->SetTextColor(0, 0, 0);

    // Tambah garis bawah untuk header
    // $pdf->SetDrawColor(50, 50, 100);
    // $pdf->Line(10, 30, 200, 30);
    $pdf->Ln(-1);

    // Kolom Judul
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(40, 10, 'ID Produk', 1, 0, 'C', false);
    $pdf->Cell(90, 10, 'Nama Produk', 1, 0, 'C', false);
    $pdf->Cell(30, 10, 'Jumlah', 1, 0, 'C', false);
    $pdf->Cell(30, 10, 'Harga', 1, 1, 'C', false);

    $pdf->SetTextColor(0, 0, 0);


    // Isi tabel
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetFillColor(224, 235, 255); // Warna isi sel
    $fill = false; // Untuk membuat warna baris selang-seling

    for ($i = 0; $i < 5; $i++) {
        while ($row = $result->fetch_assoc()) {
            $pdf->Cell(40, 10, $row['id'], 'LR', 0, 'C', $fill);
            $pdf->Cell(90, 10, $row['nama'], 'LR', 0, 'C', $fill);
            $pdf->Cell(30, 10, $row['jumlah'], 'LR', 0, 'C', $fill);
            $pdf->Cell(30, 10, $row['harga'], 'LR', 1, 'C', $fill);
        }
    }

    // while ($row = $result->fetch_assoc()) {
    //     $pdf->Cell(40, 10, $row['id'], 'LR', 0, 'C', $fill);
    //     $pdf->Cell(90, 10, $row['nama'], 'LR', 0, 'C', $fill);
    //     $pdf->Cell(30, 10, $row['jumlah'], 'LR', 0, 'C', $fill);
    //     $pdf->Cell(30, 10, $row['harga'], 'LR', 1, 'C', $fill);
    //     $fill = !$fill; // Tukar warna di setiap baris
    // }

    // Output PDF
    $pdf->Output();
} else {
    echo "Tidak ada produk yang aktif.";
}

// Tutup koneksi
$mysqli->close();

// Selesai pengukuran waktu
$endTime = microtime(true);

// Hitung durasi
$executionTime = $endTime - $startTime;

// Simpan ke log file
file_put_contents('execution_time.log', "Waktu eksekusi: " . $executionTime . " detik", FILE_APPEND);



//fpdf done note: this library cant support html and css dibawah ini coding full namun tidak rapih
/*
require 'vendor/autoload.php';

// Mulai pengukuran waktu
$startTime = microtime(true);

// Koneksi ke database
$mysqli = new mysqli("localhost", "root", "", "test_databases");

// Cek koneksi
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Query untuk mengambil data produk berdasarkan status aktif
$query = "SELECT id, nama, jumlah, status, harga FROM data_produk WHERE status = 'aktif'";
$result = $mysqli->query($query);

// Cek apakah ada data yang ditemukan
if ($result->num_rows > 0) {
    // Membuat instance FPDF
    $pdf = new \FPDF();
    $pdf->AddPage();
    
    // Menambahkan custom font, ukuran, dan warna
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->SetTextColor(50, 50, 100);

    // Header
    $pdf->Cell(0, 10, 'Daftar Produk Aktif', 0, 1, 'C');
    $pdf->Ln(10);

    // Tambah garis bawah untuk header
    $pdf->SetDrawColor(50, 50, 100);
    $pdf->Line(10, 30, 200, 30);
    $pdf->Ln(5);

    // Kolom Judul
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(40, 10, 'ID Produk', 1, 0, 'C', true);
    $pdf->Cell(60, 10, 'Nama Produk', 1, 0, 'C', true);
    $pdf->Cell(30, 10, 'Jumlah', 1, 0, 'C', true);
    $pdf->Cell(30, 10, 'Harga', 1, 1, 'C', true);

    // Isi tabel
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetFillColor(224, 235, 255); // Warna isi sel
    $fill = false; // Untuk membuat warna baris selang-seling

    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(40, 10, $row['id'], 1, 0, 'C', $fill);
        $pdf->Cell(60, 10, $row['nama'], 1, 0, 'C', $fill);
        $pdf->Cell(30, 10, $row['jumlah'], 1, 0, 'C', $fill);
        $pdf->Cell(30, 10, $row['harga'], 1, 1, 'C', $fill);
        $fill = !$fill; // Tukar warna di setiap baris
    }

    // Output PDF
    $pdf->Output();
} else {
    echo "Tidak ada produk yang aktif.";
}

// Tutup koneksi
$mysqli->close();

// Selesai pengukuran waktu
$endTime = microtime(true);

// Hitung durasi
$executionTime = $endTime - $startTime;

// Simpan ke log file
file_put_contents('execution_time.log', "Waktu eksekusi: " . $executionTime . " detik", FILE_APPEND);
*/