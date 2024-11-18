<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Encrypted ZIP</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Create Encrypted ZIP</h1>
    <form id="zipForm">
        <input type="file" name="files" id="fileInput" multiple required>
        <input type="text" id="password" name="password" placeholder="Enter password" required>
        <button type="submit">Create ZIP</button>
    </form>
    <div id="response"></div>

    <script>
        $('#zipForm').on('submit', function (e) {
            e.preventDefault(); // Mencegah form untuk submit secara default

            let formData = new FormData();
            let files = $('#fileInput')[0].files;
            let password = $('#password').val();

            // Validasi input
            if (files.length === 0 || !password) {
                alert('Please provide files and a password.');
                return;
            }

            // Menambahkan setiap file ke formData dengan nama parameter 'inputFile'
            for (let i = 0; i < files.length; i++) {
                formData.append('inputFile', files[i]); // Ganti 'inputFile' sesuai dengan yang diharapkan oleh backend
            }

            // Menambahkan password ke formData
            formData.append('password', password);

            // Melakukan AJAX request ke backend PHP
            $.ajax({
                url: 'http://localhost/php7/tes-code-php7/javascript-zip/Cloudmersive/create-zip.php', // URL backend PHP Anda
                type: 'POST',
                data: formData,
                processData: false, // Menghindari jQuery untuk memproses data (karena kita menggunakan FormData)
                contentType: false, // Menghindari jQuery untuk mengatur Content-Type (karena kita menggunakan FormData)
                success: function (response) {
                    let jsonResponse = JSON.parse(response);
                    if (jsonResponse.url) {
                        // Menampilkan link download jika ZIP berhasil dibuat
                        $('#response').html(`<a href="${jsonResponse.url}" download>Download ZIP</a>`);
                    } else {
                        $('#response').html('<p>Failed to create ZIP file.</p>');
                    }
                },
                error: function (xhr) {
                    // Menangani jika terjadi error pada AJAX request
                    $('#response').html('<p>Error creating ZIP file.</p>');
                }
            });
        });
    </script>
</body>
</html>
