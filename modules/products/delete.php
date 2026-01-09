<?php
require '../../config/database.php';

$id = $_GET['id'];

$query = "DELETE FROM products WHERE id = '$id'";

if (mysqli_query($conn, $query)) {
    header("Location: index.php?status=deleted");
} else {
    echo "Error: " . mysqli_error($conn);
}
?>