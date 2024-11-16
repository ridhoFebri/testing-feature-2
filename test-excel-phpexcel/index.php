<?php
// Set default timezone
date_default_timezone_set('Asia/Jakarta');

// Memasukkan file PHPExcel
require 'PHPExcel/PHPExcel.php';

// Membuat objek PHPExcel
$objPHPExcel = new PHPExcel();

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Hello');
$objPHPExcel->getActiveSheet()->setCellValue('B2', 'world!');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Hello');
$objPHPExcel->getActiveSheet()->setCellValue('D2', 'world!');

// Set active sheet index ke sheet pertama, agar Excel membuka sheet ini pertama kali
$objPHPExcel->setActiveSheetIndex(0);

// Menyimpan file ke lokasi sementara
$tempFile = 'example.xls';
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save($tempFile); // Menyimpan ke file sementara


$password = 'pass';
$outfile = 'download.zip';
$infile = 'file.txt';

// Set headers to force the file download
header("Content-type: application/octet-stream");
header("Content-disposition: attachment; filename=$outfile");

// Create a zip file with password protection using the system command
$zipCommand = "zip -P $password $outfile $infile";

// Execute the zip command
@system($zipCommand);

// Check if the file exists before trying to send it
if (file_exists($outfile)) {
    // Send the file to the user
    readfile($outfile);

    // Delete the zip file after sending
    @unlink($outfile);
} else {
    echo "Error: The zip file was not created successfully.";
}

/*
// Define the zip file name and files to add
$zipFileName = 'protected.zip';
$filesToZip = ['file1.txt'];
$password = 'your_password';

// Create a new ZipArchive instance
$zip = new ZipArchive();

// Open the zip file for creation
if ($zip->open($zipFileName, ZipArchive::CREATE) === TRUE) {
    // Set the password for the entire zip file (only ZipArchive::CM_PKWARE for PHP 5)
    $zip->setPassword($password);
    
    // Add each file to the zip without individual file encryption
    foreach ($filesToZip as $file) {
        $zip->addFile($file);
    }

    // Close the zip archive
    $zip->close();
    echo "ZIP file created and password protected!";
} else {
    echo "Failed to create ZIP file.";
}

*/

?>

<?php
/*
// Set the default timezone
date_default_timezone_set('Asia/Jakarta');

// Memasukkan file PHPExcel
require 'PHPExcel/PHPExcel.php';

// Membuat objek PHPExcel
$objPHPExcel = new PHPExcel();

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Hello');
$objPHPExcel->getActiveSheet()->setCellValue('B2', 'world!');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Hello');
$objPHPExcel->getActiveSheet()->setCellValue('D2', 'world!');

$objPHPExcel->getSecurity()->setLockWindows(true);
$objPHPExcel->getSecurity()->setLockStructure(true);
$objPHPExcel->getSecurity()->setWorkbookPassword("PHPExcel");


$objPHPExcel->getActiveSheet()->getProtection()->setPassword('PHPExcel');
$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true); // This should be enabled in order to enable any of the following!
$objPHPExcel->getActiveSheet()->getProtection()->setSort(true);
$objPHPExcel->getActiveSheet()->getProtection()->setInsertRows(true);
$objPHPExcel->getActiveSheet()->getProtection()->setFormatCells(true);

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Write the file to a temporary location
$tempFile = 'example.xls';
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save($tempFile); // Save to a temporary file

// Create a zip file
$zip = new ZipArchive();
$zipFileName = 'example.zip';

if ($zip->open($zipFileName, ZipArchive::CREATE) !== TRUE) {
    exit("Cannot open <$zipFileName>\n");
}

$zip->addFile($tempFile, basename($tempFile)); // Add the Excel file to the zip

$zip->close();

// Set headers to prompt the browser to download the zip file
header('Content-Type: application/zip');
header('Content-Disposition: attachment;filename="' . $zipFileName . '"');
header('Cache-Control: max-age=0');

// Output the zip file
readfile($zipFileName);

// Clean up temporary files
unlink($tempFile); // Delete the temporary Excel file
unlink($zipFileName); // Delete the zip file
exit();
?>

<!-- $password = 'pass';
$outfile = 'download.zip';
$infile = 'file.txt';

header("Content-type: application/octet-stream");
header("Content-disposition: attachment; filename=$outfile");

@system("zip -P $password $outfile $infile");
readfile($outfile);
@unlink($outfile); -->
*/ ?>


<?php

/* 
// Set the default timezone
date_default_timezone_set('Asia/Jakarta');

// Memasukkan file PHPExcel
require 'PHPExcel/PHPExcel.php';

// Membuat objek PHPExcel
$objPHPExcel = new PHPExcel();

// Set password against the spreadsheet file
$objPHPExcel->getSecurity()->setLockWindows(true);
$objPHPExcel->getSecurity()->setLockStructure(true);
$objPHPExcel->getSecurity()->setWorkbookPassword('secret');


// Save Excel 2007 file
echo date('H:i:s') , " Write to Excel2007 format";
$callStartTime = microtime(true);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
$callEndTime = microtime(true);
$callTime = $callEndTime - $callStartTime;

echo date('H:i:s') , " File written to " , str_replace('.php', '.xlsx', pathinfo(__FILE__, PATHINFO_BASENAME));
echo 'Call time to write Workbook was ' , sprintf('%.4f',$callTime) , " seconds";
// Echo memory usage
echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB";


// Save Excel 95 file
echo date('H:i:s') , " Write to Excel5 format";
$callStartTime = microtime(true);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save(str_replace('.php', '.xls', __FILE__));
$callEndTime = microtime(true);
$callTime = $callEndTime - $callStartTime;

echo date('H:i:s') , " File written to " , str_replace('.php', '.xls', pathinfo(__FILE__, PATHINFO_BASENAME));
echo 'Call time to write Workbook was ' , sprintf('%.4f',$callTime) , " seconds";
// Echo memory usage
echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB";


// Echo memory peak usage
echo date('H:i:s') , " Peak memory usage: " , (memory_get_peak_usage(true) / 1024 / 1024) , " MB";

// Echo done
echo date('H:i:s') , " Done writing files";
echo 'Files have been created in ' , getcwd();




// Set the default timezone
date_default_timezone_set('Asia/Jakarta');

// Memasukkan file PHPExcel
require 'PHPExcel/PHPExcel.php';

// Membuat objek PHPExcel
$objPHPExcel = new PHPExcel();

// Add some data
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Hello');
$objPHPExcel->getActiveSheet()->setCellValue('B2', 'world!');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Hello');
$objPHPExcel->getActiveSheet()->setCellValue('D2', 'world!');

$objPHPExcel->getSecurity()->setLockWindows(true);
$objPHPExcel->getSecurity()->setLockStructure(true);
$objPHPExcel->getSecurity()->setWorkbookPassword("PHPExcel");


$objPHPExcel->getActiveSheet()->getProtection()->setPassword('PHPExcel');
$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true); // This should be enabled in order to enable any of the following!
$objPHPExcel->getActiveSheet()->getProtection()->setSort(true);
$objPHPExcel->getActiveSheet()->getProtection()->setInsertRows(true);
$objPHPExcel->getActiveSheet()->getProtection()->setFormatCells(true);

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Set headers to prompt the browser to download the file
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="example.xls"');
header('Cache-Control: max-age=0');

// Write the file to the output buffer
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output'); // Output to the browser
exit();


*/

/*

// Set the default timezone
date_default_timezone_set('Asia/Jakarta');

// Memasukkan file PHPExcel
require 'PHPExcel/PHPExcel.php';

// Membuat objek PHPExcel
$objPHPExcel = new PHPExcel();

// Create a first sheet, representing sales data
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Something');

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Name of Sheet 1');

// Create a new worksheet, after the default sheet
$objPHPExcel->createSheet();

// Add some data to the second sheet, resembling some different data types
$objPHPExcel->setActiveSheetIndex(1);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'More data');

// Rename 2nd sheet
$objPHPExcel->getActiveSheet()->setTitle('Second sheet');

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="name_of_file.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');

*/

/*

// Set the default timezone
date_default_timezone_set('Asia/Jakarta');

// Memasukkan file PHPExcel
require 'PHPExcel/PHPExcel.php';

// Membuat objek PHPExcel
$objPHPExcel = new PHPExcel();



// Set password against the spreadsheet file
$objPHPExcel->getSecurity()->setLockWindows(true);
$objPHPExcel->getSecurity()->setLockStructure(true);
$objPHPExcel->getSecurity()->setWorkbookPassword('secret');

// Save Excel 2007 file
echo date('H:i:s') . " Write to Excel2007 format" . PHP_EOL;
$callStartTime = microtime(true);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
$callEndTime = microtime(true);
$callTime = $callEndTime - $callStartTime;

echo date('H:i:s') . " File written to " . str_replace('.php', '.xlsx', pathinfo(__FILE__, PATHINFO_BASENAME)) . PHP_EOL;
echo 'Call time to write Workbook was ' . sprintf('%.4f',$callTime) . " seconds" . PHP_EOL;
// Echo memory usage
echo date('H:i:s') . ' Current memory usage: ' . (memory_get_usage(true) / 1024 / 1024) . " MB" . PHP_EOL;


// Save Excel 95 file
echo date('H:i:s') . " Write to Excel5 format" . PHP_EOL;
$callStartTime = microtime(true);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save(str_replace('.php', '.xls', __FILE__));
$callEndTime = microtime(true);
$callTime = $callEndTime - $callStartTime;

echo date('H:i:s') . " File written to " . str_replace('.php', '.xls', pathinfo(__FILE__, PATHINFO_BASENAME)) . PHP_EOL;
echo 'Call time to write Workbook was ' . sprintf('%.4f',$callTime) . " seconds" . PHP_EOL;
// Echo memory usage
echo date('H:i:s') . ' Current memory usage: ' . (memory_get_usage(true) / 1024 / 1024) . " MB" . PHP_EOL;


// Echo memory peak usage
echo date('H:i:s') . " Peak memory usage: " . (memory_get_peak_usage(true) / 1024 / 1024) . " MB" . PHP_EOL;

// Echo done
echo date('H:i:s') . " Done writing files" . PHP_EOL;
echo 'Files have been created in ' . getcwd() . PHP_EOL;

*/