const XlsxPopulate = require('xlsx-populate');

// Membuat workbook baru
XlsxPopulate.fromBlankAsync()
    .then(workbook => {
        // Modifikasi workbook
        workbook.sheet("Sheet1").cell("A1").value("This is neat!");

        // Menyimpan workbook ke file baru dengan password
        return workbook.toFileAsync("./out.xlsx", { password: "ridho" });
    })
    .catch(err => {
        console.error("Error:", err);
    });
