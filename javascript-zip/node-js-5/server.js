const express = require("express");
const crypto = require("crypto");
const app = express();
const port = 3000;

// Middleware untuk melayani file statis
app.use(express.static("public"));

// Endpoint untuk menghasilkan token
app.get("/generate-token", (req, res) => {
  const token = crypto.randomBytes(16).toString("hex"); // 16-byte token
  res.json({ token });
});

// Jalankan server
app.listen(port, () => {
  console.log(`Server berjalan di http://localhost:${port}`);
});
