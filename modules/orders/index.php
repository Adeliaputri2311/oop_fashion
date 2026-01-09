<?php 
require '../../session_check.php';
require '../../config/database.php';

$orders = mysqli_query($conn, "SELECT * FROM orders ORDER BY order_date DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sales Orders | Jenstore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --primary-rose: #ff758f; --bg-body: #fdfafb; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--bg-body); color: #4a4a4a; }
        .main-content { margin-left: 280px; padding: 50px 40px; }
        .page-title { font-weight: 800; letter-spacing: -1.5px; font-size: 2.5rem; background: linear-gradient(45deg, #ff758f, #ffafbd); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .glass-card { background: white; border-radius: 30px; box-shadow: 0 10px 40px rgba(0,0,0,0.02); padding: 15px; border: none; }
        .btn-new-order { background: #2d2327; color: white; border-radius: 15px; padding: 12px 25px; font-weight: 700; text-decoration: none; transition: 0.3s; }
        .btn-new-order:hover { background: var(--primary-rose); color: white; transform: translateY(-2px); }
        .table { border-collapse: separate; border-spacing: 0 5px; }
        .table thead th { color: #b0b0b0; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1.5px; border: none; padding: 20px 25px; }
        .table tbody td { border: none; padding: 20px 25px; background: white; }
        .order-no { font-weight: 800; color: #eee; font-size: 1.1rem; }
    </style>
</head>
<body>

    <?php include '../../sidebar.php'; ?>

    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h1 class="page-title">Orders</h1>
                <p class="text-muted mb-0">Riwayat transaksi penjualan Jenstore.</p>
            </div>
            <a href="create.php" class="btn-new-order shadow-sm">+ New Transaction</a>
        </div>

        <div class="glass-card">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th width="100">Index</th>
                        <th>Date</th>
                        <th>Customer</th>
                        <th>Total Amount</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1; 
                    while($row = mysqli_fetch_assoc($orders)) : 
                    ?>
                    <tr>
                        <td><span class="order-no"><?= str_pad($no++, 2, "0", STR_PAD_LEFT); ?></span></td>
                        <td><?= date('d M Y, H:i', strtotime($row['order_date'])); ?></td>
                        <td class="fw-bold"><?= strtoupper($row['customer_name']); ?></td>
                        <td class="fw-bold text-success">Rp <?= number_format($row['total_price'], 0, ',', '.'); ?></td>
                        <td class="text-center">
                            <a href="detail.php?id=<?= $row['id']; ?>" class="text-muted fw-bold text-decoration-none small">VIEW DETAIL</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>