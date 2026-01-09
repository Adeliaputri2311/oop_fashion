<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Jika belum login, arahkan ke halaman login
if (!isset($_SESSION['login'])) {
    // Kita gunakan path relatif yang menuju ke folder modules/auth/
    header("Location: modules/auth/login.php");
    exit;
}
?>