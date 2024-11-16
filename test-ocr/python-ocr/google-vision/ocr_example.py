from google.cloud import vision
import io

def detect_text_from_image(image_path):
    # Membuat client Vision API
    client = vision.ImageAnnotatorClient()

    # Membaca gambar
    with io.open(image_path, 'rb') as image_file:
        content = image_file.read()

    # Membuat objek Image
    image = vision.Image(content=content)

    # Memanggil API OCR
    response = client.text_detection(image=image)

    # Menangani response
    if response.error.message:
        raise Exception(f"Error in OCR request: {response.error.message}")

    # Mendapatkan hasil teks dari gambar
    texts = response.text_annotations
    print("Teks yang ditemukan:")
    for text in texts:
        print(f"'{text.description}'")

    return texts[0].description if texts else None

# Contoh penggunaan
image_path = '8055.png'  # Gantilah dengan path gambar yang ingin diproses
detected_text = detect_text_from_image(image_path)
print(f"Output OCR: {detected_text}")
