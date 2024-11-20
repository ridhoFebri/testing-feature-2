const XlsxPopulate = require('xlsx-populate');

// Membuat workbook baru
XlsxPopulate.fromBlankAsync()
    .then(workbook => {
        // Modifikasi workbook
        workbook.sheet("Sheet1").cell("A1").value("This is neat!");

        // Menyimpan workbook ke file baru dengan password
        return workbook.toFileAsync("./out.xlsx", { password: "febrian" });
    })
    .catch(err => {
        console.error("Error:", err);
    });


/*
// file from out 
    const XlsxPopulate = require('xlsx-populate');

    // Membuat workbook dari file yang sudah ada
    XlsxPopulate.fromFileAsync("./Book1.xlsx") // Ganti dengan nama file Anda
        .then(workbook => {
            // Menyimpan workbook ke file baru dengan password
            return workbook.toFileAsync("./out.xlsx", { password: "febrian" });
        })
        .catch(err => {
            console.error("Error:", err);
        });

        */