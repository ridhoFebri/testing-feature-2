<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zip File Creator</title>
</head>
<body>
    <h1>Upload Files and Create ZIP</h1>
    <input type="file" id="fileInput" multiple />
    <button onclick="createZip()">Create ZIP</button>
    <br><br>
    <a id="downloadLink" style="display:none" href="#">Download ZIP</a>
    <script src="https://unpkg.com/jszip@3.7.1/dist/jszip.min.js"></script>
</body>
</html>
<script>
    function createZip() {
    // Ambil file yang dipilih oleh pengguna
    const files = document.getElementById('fileInput').files;
    
    if (files.length === 0) {
        alert("Please select files to create ZIP");
        return;
    }

    // Membuat instance JSZip
    const zip = new JSZip();

    // Menambahkan setiap file yang diunggah ke dalam zip
    for (let i = 0; i < files.length; i++) {
        let file = files[i];
        zip.file(file.name, file);
    }

    // Membuat file ZIP dan menyiapkan link download
    zip.generateAsync({ type: "blob" }).then(function(content) {
        // Membuat URL untuk file ZIP
        const link = document.getElementById('downloadLink');
        link.href = URL.createObjectURL(content);
        link.download = "created.zip";  // Nama file zip yang dihasilkan
        link.style.display = 'inline'; // Tampilkan link untuk unduh
        link.textContent = "Download your ZIP";
    });
}

</script>