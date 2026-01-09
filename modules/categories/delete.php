<?php
require '../../session_check.php';
require '../../config/database.php';

$id = $_GET['id'];

// Hapus kategori berdasarkan ID
if (mysqli_query($conn, "DELETE FROM categories WHERE id = $id")) {
    header("Location: index.php");
} else {
    echo "Gagal menghapus kategori.";
}
?>