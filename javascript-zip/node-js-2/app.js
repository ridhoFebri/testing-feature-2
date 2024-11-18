const express = require('express');
const fs = require('fs-extra');
const multer = require('multer');
const Minizip = require('minizip-asm.js');
const path = require('path');

// Inisialisasi Express
const app = express();
const port = 3000;

// Set up Multer untuk file upload
const upload = multer({ dest: 'uploads/' });

// Menyajikan file HTML dan static assets
app.use(express.static('public'));

// API endpoint untuk menangani zip
app.post('/zip', upload.array('files'), async (req, res) => {
    const password = req.body.password;
    const files = req.files;

    // Membuat folder sementara untuk file yang di-upload
    const tempDir = path.join(__dirname, 'zipped');
    await fs.ensureDir(tempDir);

    // Pindahkan file yang di-upload ke folder "zipped"
    for (let file of files) {
        await fs.move(file.path, path.join(tempDir, file.originalname));
    }

    // Proses pembuatan zip
    const outputZip = path.join(__dirname, 'output.zip');
    try {
        await zipDirectory(tempDir, outputZip, password);
        res.status(200).send('Zip created successfully!');
    } catch (err) {
        console.error('Error:', err);
        res.status(500).send('Error zipping the files');
    }
});

// Fungsi untuk meng-zip folder
async function zipDirectory(source, output, password) {
    const mz = new Minizip();
    const files = await fs.readdir(source);

    for (let file of files) {
        const filePath = `${source}/${file}`;
        const fileData = await fs.readFile(filePath);
        mz.append(file, fileData, { password: password });
    }

    const data = new Uint8Array(mz.zip());
    await fs.writeFile(output, data);
}

// Menjalankan server
app.listen(port, () => {
    console.log(`Server is running at http://localhost:${port}`);
});
