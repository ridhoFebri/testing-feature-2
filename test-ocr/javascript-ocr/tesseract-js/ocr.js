const Tesseract = require('tesseract.js');

// Fungsi untuk memproses gambar dan mengekstrak teks menggunakan OCR
function extractTextFromImage(imagePath) {
  Tesseract.recognize(
    imagePath,             // Path gambar yang akan diproses
    'eng',                 // Bahasa yang digunakan (dalam hal ini bahasa Inggris)
    {
      logger: (m) => console.log(m) // Menampilkan progres di console
    }
  ).then(({ data: { text } }) => {
    console.log('Hasil OCR: ', text); // Menampilkan hasil teks yang diambil dari gambar
  }).catch(error => {
    console.error('Terjadi kesalahan: ', error);
  });
}

// Path gambar yang ingin diproses
const imagePath = 'kk.png';  // Ganti dengan path gambar kamu
extractTextFromImage(imagePath);

 
/*
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OCR dengan Tesseract.js</title>
</head>
<body>
  <h1>OCR menggunakan Tesseract.js</h1>
  <input type="file" id="file-input" />
  <button onclick="processImage()">Proses Gambar</button>
  <pre id="output"></pre>

  <script src="https://cdn.jsdelivr.net/npm/tesseract.js@2.1.4/dist/tesseract.min.js"></script>
  <script>
    function processImage() {
      const fileInput = document.getElementById('file-input');
      const output = document.getElementById('output');
      
      if (fileInput.files.length === 0) {
        alert('Pilih gambar terlebih dahulu');
        return;
      }

      const imageFile = fileInput.files[0];
      
      Tesseract.recognize(
        imageFile,
        'eng',
        {
          logger: (m) => console.log(m)
        }
      ).then(({ data: { text } }) => {
        output.textContent = 'Hasil OCR:\n' + text;
      }).catch((error) => {
        console.error('Terjadi kesalahan: ', error);
      });
    }
  </script>
</body>
</html>

*/