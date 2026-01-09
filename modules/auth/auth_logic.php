<?php
session_start();
// Menghubungkan ke database. Path mundur 2 kali karena file ini ada di modules/auth/
require_once "../../config/database.php";

// PROSES LOGIN
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Cari user berdasarkan username
    $query  = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    // Cek apakah username ditemukan
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        // Cek apakah password cocok (menggunakan password_verify karena di register dipasang password_hash)
        if (password_verify($password, $row['password'])) {
            
            // Set Session
            $_SESSION['login'] = true;
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];

            // Redirect ke Dashboard utama
            header("Location: ../../index.php");
            exit;
        }
    }

    // Jika gagal, balik ke login.php dengan pesan error
    header("Location: login.php?pesan=gagal");
    exit;
}

// PROSES REGISTER
if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Enkripsi password agar aman di database
    $password_aman = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, password, role) VALUES ('$username', '$password_aman', 'customer')";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Registrasi Berhasil! Silakan Login.');
                window.location='login.php';
            </script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>