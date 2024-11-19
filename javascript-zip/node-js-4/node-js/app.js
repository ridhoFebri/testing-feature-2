const XlsxPopulate = require('xlsx-populate');
const fs = require('fs');

// Ambil argumen dari command line
const [filename, password, cellData] = process.argv.slice(2);

// Debugging: tampilkan argumen yang diterima
console.log("Arguments:", filename, password, cellData);

// Pastikan semua argumen ada
if (!filename || !password || !cellData) {
    console.error("Error: Argument 'filename', 'password', atau 'cellData' hilang.");
    process.exit(1); // Keluar dengan error code
}

const data = JSON.parse(cellData);

// Fungsi untuk membuat file Excel
XlsxPopulate.fromBlankAsync()
    .then(workbook => {
        const sheet = workbook.sheet("Sheet1");
        Object.keys(data).forEach(cell => {
            sheet.cell(cell).value(data[cell]);
        });

        return workbook.toFileAsync(`./${filename}`, { password });
    })
    .then(() => {
        console.log("File Excel berhasil dibuat!");
    })
    .catch(err => {
        console.error("Error:", err);
        process.exit(1); // Keluar dengan error code
    });
