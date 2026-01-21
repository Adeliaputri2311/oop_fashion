<?php
require '../../session_check.php';
require '../../config/database.php';

$id = mysqli_real_escape_string($conn, $_GET['id']);

// 1. Ambil data utama Order (Nama Customer & Tanggal)
$order_query = mysqli_query($conn, "SELECT * FROM orders WHERE id = '$id'");
$order = mysqli_fetch_assoc($order_query);

// 2. Ambil detail item yang dibeli
$detail_query = "SELECT order_details.*, products.name 
                 FROM order_details 
                 JOIN products ON order_details.product_id = products.id 
                 WHERE order_details.order_id = '$id'";
$details = mysqli_query($conn, $detail_query);

// Jika ID order tidak ditemukan di database
if (!$order) {
    echo "<script>alert('Data transaksi tidak ditemukan!'); window.location='index.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Transaction Detail | Jenstore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-rose: #ff758f;
            --bg-body: #fdfafb;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-body);
        }

        .main-content {
            margin-left: 280px;
            padding: 50px 40px;
        }

        .detail-card {
            background: white;
            border-radius: 35px;
            border: none;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.02);
        }
    </style>
</head>

<body>
    <?php include '../../sidebar.php'; ?>
    <div class="main-content">
        <div class="mb-5">
            <h1 class="fw-800" style="letter-spacing: -1.5px;">Transaction Detail</h1>
            <a href="index.php" class="text-muted text-decoration-none">← Kembali ke Riwayat</a>
        </div>

        <div class="detail-card col-md-6">
            <div class="mb-4">
                <small class="text-muted d-block">CUSTOMER</small>
                <h4 class="fw-bold"><?= strtoupper($order['customer_name'] ?? 'GUEST'); ?></h4>
            </div>
            <hr class="opacity-50">
            <div class="py-3">
                <?php
                $grand_total = 0;
                while ($item = mysqli_fetch_assoc($details)) :
                    $grand_total += $item['subtotal'];
                ?>
                    <div class="d-flex justify-content-between mb-2">
                        <span><?= $item['name']; ?> (x<?= $item['quantity']; ?>)</span>
                        <span class="fw-bold">Rp <?= number_format($item['subtotal'], 0, ',', '.'); ?></span>
                    </div>
                <?php endwhile; ?>
            </div>
            <hr class="opacity-50">
            <div class="d-flex justify-content-between align-items-center mt-3">
                <span class="fw-bold">TOTAL BAYAR</span>
                <h3 class="fw-800 text-rose" style="color: var(--primary-rose);">
                    Rp <?= number_format($order['total_price'], 0, ',', '.'); ?>
                </h3>
            </div>
            <div class="mt-4 small text-muted text-center">
                Waktu Transaksi: <?= date('d F Y, H:i', strtotime($order['order_date'])); ?>
            </div>
        </div>
    </div>
</body>

</html>