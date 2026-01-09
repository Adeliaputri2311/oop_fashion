<?php
require '../../session_check.php';
require '../../config/database.php';

if (isset($_POST['add_category'])) {
    $name = mysqli_real_escape_string($conn, $_POST['category_name']);

    $query = "INSERT INTO categories (category_name) VALUES ('$name')";
    
    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>