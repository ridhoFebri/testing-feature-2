<?php 
public function upload_excel()
{
    $this->load->helper('url');
    $this->load->helper('form');

    // Pastikan file sudah di-upload
    if (!empty($_FILES['excelFile']['name'])) {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'xlsx|xls';
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('excelFile')) {
            // Jika gagal upload
            echo $this->upload->display_errors();
        } else {
            $data = $this->upload->data();
            $filePath = $data['full_path'];

            // Menjalankan perintah untuk memulai server Node.js menggunakan exec
            $command = 'node /path/to/your/project/server.js';
            $output = null;
            $resultCode = null;

            // Eksekusi perintah untuk menjalankan Node.js server
            exec($command, $output, $resultCode);

            // Cek apakah perintah berhasil dijalankan
            if ($resultCode === 0) {
                // Server Node.js berhasil dijalankan
                echo "Node.js server berhasil dijalankan!";
            } else {
                // Gagal menjalankan server
                echo "Terjadi kesalahan saat menjalankan Node.js server.";
            }
        }
    }
}