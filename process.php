<?php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];
    $email = $_POST['email'];
    
    // Get browser and IP information
    $browser = $_SERVER['HTTP_USER_AGENT'];
    $ip = $_SERVER['REMOTE_ADDR'];

    $db = new Koneksi();
    $conn = $db->getConnection();

    // Server-side validation
    $errors = [];
    
    if (!preg_match('/^\d{9}$/', $nim)) {
        $errors[] = "NIM harus 9 digit angka";
    }
    
    if (strlen($nama) < 3) {
        $errors[] = "Nama minimal 3 karakter";
    }
    
    if (empty($prodi)) {
        $errors[] = "Program studi harus dipilih";
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid";
    }

    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO mahasiswa (nim, nama, prodi, email, browser_info, ip_address) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $nim, $nama, $prodi, $email, $browser, $ip);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Data mahasiswa berhasil disimpan";
            
            // Set cookie for last submission
            setcookie("last_submission", date("Y-m-d H:i:s"), time() + (86400 * 30), "/");
            
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['message'] = "Error: " . $conn->error;
        }
    } else {
        $_SESSION['message'] = "Error: " . implode(", ", $errors);
    }
    
    header("Location: index.php");
    exit();
}
?>