<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Fashion Store</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<nav>
    <a href="index.php">Home</a>
    <?php if(isset($_SESSION['login'])): ?>
        <a href="admin/dashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <a href="login.php">Login</a>
    <?php endif; ?>
</nav>