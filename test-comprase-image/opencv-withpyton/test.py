import cv2
import numpy as np
import os

# Set direktori kerja ke folder script (gunakan path absolut jika diperlukan)
os.chdir('C:/laragon/www/php7/tes-code-php7/test-comprase-image/opencv-withpyton')

# Baca gambar asli
image = cv2.imread('kk-asli.jpeg')

# Pastikan gambar terbaca
if image is None:
    print("Error: Gambar tidak ditemukan atau path salah.")
else:
    # Terapkan filter penajaman
    kernel = np.array([[-1, -1, -1], [-1, 9, -1], [-1, -1, -1]])  # Kernel untuk sharpening
    sharpened = cv2.filter2D(image, -1, kernel)

    # Konversi gambar yang telah diperjelas menjadi hitam putih (grayscale)
    gray_image = cv2.cvtColor(sharpened, cv2.COLOR_BGR2GRAY)

    # Simpan hasil gambar yang lebih jelas dan hitam putih
    cv2.imwrite('clear_image_bw.jpg', gray_image)
    print("Gambar berhasil diproses, diperjelas, dikonversi menjadi hitam putih, dan disimpan sebagai 'clear_image_bw.jpg'.")
