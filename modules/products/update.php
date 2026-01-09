<?php
require '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $category_id = $_POST['category_id'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    $query = "UPDATE products SET 
              name = '$name', 
              category_id = '$category_id', 
              price = '$price', 
              stock = '$stock' 
              WHERE id = '$id'";

    if (mysqli_query($conn, $query)) {
        header("Location: index.php?status=updated");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>