<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "fashion_db";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Fungsi Query Builder Sederhana
function viewData($table) {
    global $conn;
    $query = "SELECT * FROM $table";
    return mysqli_query($conn, $query);
}

function deleteData($table, $id) {
    global $conn;
    $query = "DELETE FROM $table WHERE id = $id";
    return mysqli_query($conn, $query);
}
?>