<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OCR dengan Tesseract.js</title>
  <script src="https://cdn.jsdelivr.net/npm/tesseract.js@2.1.4/dist/tesseract.min.js"></script>
</head>
<body>
  <h1>OCR Menggunakan Tesseract.js</h1>
  
  <!-- Input untuk memilih gambar -->
  <input type="file" id="image-input" accept="image/*">
  
  <!-- Tombol untuk memulai proses OCR -->
  <button onclick="processOCR()">Proses OCR</button>

  <!-- Tempat untuk menampilkan hasil OCR -->
  <h2>Hasil OCR:</h2>
  <pre id="output"></pre>

  <script>
    function processOCR() {
      const input = document.getElementById('image-input');
      const output = document.getElementById('output');
      
      if (input.files.length === 0) {
        alert('Pilih gambar terlebih dahulu');
        return;
      }

      const imageFile = input.files[0];
      
      // Menampilkan pesan loading
      output.textContent = 'Memproses gambar...';
      
      // Menggunakan Tesseract.js untuk memproses gambar
      Tesseract.recognize(
        imageFile,         // Gambar yang dipilih
        'eng',             // Bahasa yang digunakan (bahasa Inggris)
        {
          logger: (m) => console.log(m) // Menampilkan log untuk progres
        }
      ).then(({ data: { text } }) => {
        // Menampilkan hasil OCR pada elemen output
        output.textContent = 'Hasil OCR:\n' + text;
      }).catch((error) => {
        console.error('Terjadi kesalahan: ', error);
        output.textContent = 'Terjadi kesalahan dalam memproses gambar';
      });
    }
  </script>
</body>
</html>
