document.getElementById('uploadButton').addEventListener('click', function() {
    const imageInput = document.getElementById('imageInput');
    const file = imageInput.files[0];
  
    if (file) {
      const formData = new FormData();
      formData.append('file', file);
      formData.append('apikey', 'K88599797388957'); // Ganti dengan API Key kamu
  
      // Mengirimkan permintaan ke OCR.space API
      fetch('https://api.ocr.space/parse/image', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.OCRExitCode === 1) {
          // Menampilkan hasil OCR
          document.getElementById('output').textContent = data.ParsedResults[0].ParsedText;
        } else {
          document.getElementById('output').textContent = 'Error: ' + data.ErrorMessage;
        }
      })
      .catch(error => {
        console.error('Error:', error);
      });
    } else {
      alert('Please upload an image.');
    }
  });
  