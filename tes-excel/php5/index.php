<?php
require_once __DIR__ . '/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$spreadsheet->setActiveSheetIndex(0);
$spreadsheet->getActiveSheet()->setCellValue('A1', 'ON');
$spreadsheet->getActiveSheet()->setCellValue('B1', 'SK');
$spreadsheet->getActiveSheet()->setCellValue('A2', 'geg');
$spreadsheet->getActiveSheet()->setCellValue('B2', 'ger');

// Save the Excel file
$excelFile = 'ls.xlsx';
$writer = new Xlsx($spreadsheet);
$writer->save($excelFile);

// Create a zip file and add the Excel file to it
$zip = new ZipArchive();
$zipFileName = 'files.zip';

if ($zip->open($zipFileName, ZipArchive::CREATE) === TRUE) {
    $zip->addFile($excelFile, basename($excelFile));
    $zip->setPassword("YourPasswordHere");
    $zip->setEncryptionName(basename($excelFile), ZipArchive::EM_AES_256); // Menggunakan enkripsi AES-256

    $zip->close();
    echo "Zip file created successfully.";
} else {
    echo "Failed to create zip file.";
}

// Optional: Delete the Excel file after adding it to the zip
unlink($excelFile);
?>

<?php
  /* require_once __DIR__ . '/vendor/autoload.php';
  use PhpOffice\PhpSpreadsheet\Spreadsheet;
  use PhpOffice\PhpSpreadsheet\IOFactory;

  use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
  $spreadsheet = new Spreadsheet();
  $spreadsheet->setActiveSheetIndex(0);
  $spreadsheet->getActiveSheet()->setCellValue('A1', 'ON');
  $spreadsheet->getActiveSheet()->setCellValue('B1', 'SK');
  $spreadsheet->getActiveSheet()->setCellValue('A2', 'geg');
  $spreadsheet->getActiveSheet()->setCellValue('B2', 'ger');

  // Set document security
  // $spreadsheet->getSecurity()->setLockWindows(true);
  // $spreadsheet->getSecurity()->setLockStructure(true);
  // $spreadsheet->getSecurity()->setWorkbookPassword('PhpSpreadsheet');

  // Set sheet security
  $spreadsheet->getActiveSheet()->getProtection()->setPassword('PhpSpreadsheet');
  $spreadsheet->getActiveSheet()->getProtection()->setSheet(true); 
  $spreadsheet->getActiveSheet()->getProtection()->setSort(true);
  $spreadsheet->getActiveSheet()->getProtection()->setInsertRows(true);
  $spreadsheet->getActiveSheet()->getProtection()->setFormatCells(true);

  $writer = new Xlsx($spreadsheet);
  $writer->save('ls.xlsx'); */ ?>