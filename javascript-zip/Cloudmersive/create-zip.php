<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_FILES['inputFile']) && !empty($_POST['password'])) {
        $password = $_POST['password'];
        $files = $_FILES['inputFile']; // Sesuaikan dengan field yang dikirim frontend

        $boundary = uniqid();
        $delimiter = '-------------' . $boundary;
        $fields = ['password' => $password];
        $apiUrl = "https://api.cloudmersive.com/convert/archive/zip/create/encrypted";

        // Prepare file data
        $postData = '';
        foreach ($fields as $name => $value) {
            $postData .= "--$delimiter\r\n";
            $postData .= "Content-Disposition: form-data; name=\"$name\"\r\n\r\n";
            $postData .= "$value\r\n";
        }

        // Handle single or multiple files
        if (isset($files['name']) && is_array($files['name'])) {
            // Multiple files
            for ($i = 0; $i < count($files['name']); $i++) {
                if ($files['error'][$i] === UPLOAD_ERR_OK) {
                    $filePath = $files['tmp_name'][$i];
                    $fileName = $files['name'][$i];

                    $postData .= "--$delimiter\r\n";
                    $postData .= "Content-Disposition: form-data; name=\"inputFile\"; filename=\"$fileName\"\r\n";
                    $postData .= "Content-Type: application/octet-stream\r\n\r\n";
                    $postData .= file_get_contents($filePath) . "\r\n";
                } else {
                    echo json_encode(['error' => 'File upload error']);
                    exit;
                }
            }
        } else {
            // Single file
            if ($files['error'] === UPLOAD_ERR_OK) {
                $filePath = $files['tmp_name'];
                $fileName = $files['name'];

                $postData .= "--$delimiter\r\n";
                $postData .= "Content-Disposition: form-data; name=\"inputFile\"; filename=\"$fileName\"\r\n";
                $postData .= "Content-Type: application/octet-stream\r\n\r\n";
                $postData .= file_get_contents($filePath) . "\r\n";
            } else {
                echo json_encode(['error' => 'File upload error']);
                exit;
            }
        }

        $postData .= "--$delimiter--\r\n";

        // Prepare cURL request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: multipart/form-data; boundary=$delimiter",
            "Apikey: YOUR_API_KEY_HERE"
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            // Handle cURL error
            $errorMsg = curl_error($ch);
            curl_close($ch);
            http_response_code(500);
            echo json_encode(['error' => 'cURL Error: ' . $errorMsg]);
            exit;
        }
        
        curl_close($ch);

        if ($httpCode === 200) {
            // Return successful response
            header('Content-Type: application/json');
            echo $response;
        } else {
            // Handle API response error
            http_response_code($httpCode);
            echo json_encode(['error' => 'Failed to create ZIP file. HTTP Code: ' . $httpCode]);
        }
    } else {
        // Handle invalid input
        http_response_code(400);
        echo json_encode(['error' => 'Invalid input. Please provide files and a password.']);
    }
} else {
    // Handle invalid request method
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed.']);
}
