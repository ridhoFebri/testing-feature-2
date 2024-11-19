<?php
// Data yang dikirim untuk Excel
$filename = "out.xlsx";
$password = "febrian";
$data = [
    "A1" => "This is neat!",
    "B1" => "Another cell"
];

// Konversi data menjadi JSON string
$dataJson = json_encode($data);

// Debugging: tampilkan perintah yang akan dijalankan
echo "Command: node app.js " . escapeshellarg($filename) . " " . escapeshellarg($password) . " " . escapeshellarg($dataJson) . "<br>";

// Jalankan script Node.js
$command = "node app.js " . escapeshellarg($filename) . " " . escapeshellarg($password) . " " . escapeshellarg($dataJson);
exec($command, $output, $returnCode);

// Debugging: tampilkan output dan return code
echo "Output: " . implode("<br>", $output) . "<br>";
echo "Return Code: " . $returnCode . "<br>";

// Periksa apakah script berjalan sukses
if ($returnCode === 0) {
    echo "File berhasil dibuat: $filename";

    // Kirim file ke browser untuk diunduh
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    readfile($filename);

    // Hapus file setelah diunduh
    unlink($filename);
} else {
    echo "Error dalam pembuatan file Excel.";
    print_r($output); // Debugging output
}
?>
