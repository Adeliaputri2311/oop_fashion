<?php 
require 'config/database.php';
require 'session_check.php';

// Ambil statistik dari database
$total_products = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM products"));
$total_categories = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM categories"));
// Menghitung total nilai stok (Harga x Stok)
$stock_query = mysqli_query($conn, "SELECT SUM(price * stock) as total FROM products");
$stock_assoc = mysqli_fetch_assoc($stock_query);
$stock_value = $stock_assoc['total'] ?? 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Overview | Jenstore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-rose: #ff758f;
            --bg-body: #fdfafb;
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-body);
            color: #2d2327;
        }

        /* Sidebar Style (Wajib disamakan dengan sidebar.php) */
        .sidebar-wrapper { width: 280px; height: 100vh; position: fixed; padding: 20px; z-index: 1000; }
        .sidebar-content { background: white; height: 100%; border-radius: 30px; box-shadow: 0 10px 40px rgba(255, 117, 143, 0.08); padding: 30px 20px; display: flex; flex-direction: column; border: 1px solid rgba(255, 255, 255, 0.5); }
        
        /* Layout Main Content */
        .main-content { margin-left: 280px; padding: 40px 40px 40px 20px; }

        /* Menu Sidebar (Visual Only for Preview in CSS) */
        .nav-link-custom { display: flex; align-items: center; padding: 14px 20px; text-decoration: none; color: #8a8184; font-weight: 600; border-radius: 18px; transition: 0.3s; }
        .nav-link-custom.active { background: var(--primary-rose); color: white; box-shadow: 0 8px 20px rgba(255, 117, 143, 0.3); }

        /* Stat Card Modern */
        .stat-card { border: none; border-radius: 30px; color: white; padding: 35px; transition: transform 0.3s ease, box-shadow 0.3s ease; border: 1px solid rgba(255,255,255,0.2); }
        .stat-card:hover { transform: translateY(-10px); box-shadow: 0 20px 30px rgba(255, 117, 143, 0.15); }
        
        .bg-rose { background: linear-gradient(135deg, #ff758f 0%, #ff8fa3 100%); }
        .bg-purple { background: linear-gradient(135deg, #7209b7 0%, #b5179e 100%); }
        .bg-dark-custom { background: #2d2327; }

        /* Welcome Card */
        .welcome-card { background: white; border-radius: 30px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.02); }
        
        .brand-section { font-weight: 800; font-size: 1.4rem; background: linear-gradient(45deg, #ff758f, #c9184a); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
    </style>
</head>
<body>

    <?php include 'sidebar.php'; ?>

    <div class="main-content">
        <div class="mb-5">
            <h1 class="fw-800" style="letter-spacing: -1.5px;">Store Overview</h1>
            <p class="text-muted">Halo <b><?= $_SESSION['username']; ?></b>, berikut ringkasan performa koleksimu.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="stat-card bg-rose shadow-lg">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="mb-1 opacity-75 fw-600 text-uppercase small" style="letter-spacing: 1px;">Total Products</p>
                            <h2 class="display-5 fw-bold mb-0"><?= $total_products; ?></h2>
                        </div>
                        <span style="font-size: 2.5rem; opacity: 0.3;">🛍️</span>
                    </div>
                    <div class="mt-3 small opacity-75">Barang siap dijual</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card bg-purple shadow-lg">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="mb-1 opacity-75 fw-600 text-uppercase small" style="letter-spacing: 1px;">Categories</p>
                            <h2 class="display-5 fw-bold mb-0"><?= $total_categories; ?></h2>
                        </div>
                        <span style="font-size: 2.5rem; opacity: 0.3;">🎀</span>
                    </div>
                    <div class="mt-3 small opacity-75">Kategori koleksi aktif</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card bg-dark-custom shadow-lg">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="mb-1 opacity-75 fw-600 text-uppercase small" style="letter-spacing: 1px;">Inventory Value</p>
                            <h3 class="fw-bold mb-0 mt-2">Rp <?= number_format($stock_value, 0, ',', '.'); ?></h3>
                        </div>
                        <span style="font-size: 2.5rem; opacity: 0.3;">💰</span>
                    </div>
                    <div class="mt-3 small opacity-75">Estimasi total nilai stok</div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <div class="welcome-card p-5 text-center border-0 shadow-sm">
                    <div class="mb-3" style="font-size: 3rem;">✨</div>
                    <h3 class="fw-bold">Ready to manage your store?</h3>
                    <p class="text-muted mx-auto mb-4" style="max-width: 500px;">
                        Data statistik di atas diperbarui secara real-time. Kamu bisa mulai mengelola produk melalui menu <b>Collections</b> di sidebar sebelah kiri.
                    </p>
                    <a href="modules/products/index.php" class="btn btn-dark px-4 py-2 rounded-pill shadow-sm">
                        Go to Collections Management
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>