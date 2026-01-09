<?php 
require '../../session_check.php';
require '../../config/database.php';

// Ambil semua kategori untuk menu Tab
$categories = mysqli_query($conn, "SELECT * FROM categories ORDER BY category_name ASC");

// Ambil kategori yang sedang aktif (default ke kategori pertama jika tidak ada yang dipilih)
$active_cat = isset($_GET['cat']) ? $_GET['cat'] : 'all';

// Logika Query Produk
if ($active_cat == 'all') {
    $query = "SELECT products.*, categories.category_name 
              FROM products 
              LEFT JOIN categories ON products.category_id = categories.id";
} else {
    $query = "SELECT products.*, categories.category_name 
              FROM products 
              LEFT JOIN categories ON products.category_id = categories.id
              WHERE products.category_id = '$active_cat'";
}
$products = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collections Management | Jenstore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --primary-rose: #ff758f; --bg-body: #fdfafb; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--bg-body); color: #2d2327; }
        .main-content { margin-left: 280px; padding: 50px 40px; }
        
        .page-title { font-weight: 800; letter-spacing: -1.5px; font-size: 2.5rem; background: linear-gradient(45deg, #ff758f, #ffafbd); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }

        /* Filter Tab Styling */
        .nav-pills-custom { display: flex; gap: 10px; overflow-x: auto; padding-bottom: 15px; white-space: nowrap; }
        .nav-pills-custom::-webkit-scrollbar { display: none; }
        
        .tab-item {
            padding: 10px 25px;
            border-radius: 15px;
            background: white;
            color: #8a8184;
            font-weight: 700;
            text-decoration: none;
            transition: 0.3s;
            border: 1px solid #eee;
            font-size: 0.85rem;
        }
        .tab-item.active {
            background: var(--primary-rose);
            color: white;
            border-color: var(--primary-rose);
            box-shadow: 0 8px 20px rgba(255, 117, 143, 0.2);
        }

        /* Table Area */
        .glass-card { background: white; border: none; border-radius: 30px; box-shadow: 0 10px 40px rgba(0,0,0,0.02); overflow: hidden; }
        .table thead th { background: #fff8f9; color: #b0b0b0; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; padding: 20px 25px; border: none; }
        .table tbody td { border-bottom: 1px solid #fdf2f4; padding: 20px 25px; }
        
        .product-dot { width: 8px; height: 8px; background: var(--primary-rose); border-radius: 50%; display: inline-block; margin-right: 12px; }
        .btn-add-modern { background: #2d2327; color: white; border-radius: 15px; padding: 12px 25px; font-weight: 700; text-decoration: none; transition: 0.3s; }
        .btn-add-modern:hover { background: var(--primary-rose); color: white; transform: translateY(-3px); }
    </style>
</head>
<body>

    <?php include '../../sidebar.php'; ?>

    <div class="main-content">
        <div class="row align-items-center mb-5">
            <div class="col">
                <h1 class="page-title">Collections</h1>
                <p class="text-muted mb-0">Browse through your luxury fashion archive.</p>
            </div>
            <div class="col-auto">
                <a href="add.php" class="btn btn-add-modern shadow-sm">+ Add New</a>
            </div>
        </div>

        <div class="nav-pills-custom mb-4">
            <a href="index.php?cat=all" class="tab-item <?= ($active_cat == 'all') ? 'active' : ''; ?>">All Collections</a>
            <?php while($cat = mysqli_fetch_assoc($categories)) : ?>
                <a href="index.php?cat=<?= $cat['id']; ?>" 
                   class="tab-item <?= ($active_cat == $cat['id']) ? 'active' : ''; ?>">
                    <?= strtoupper($cat['category_name']); ?>
                </a>
            <?php endwhile; ?>
        </div>

        <div class="glass-card">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th width="100">Index</th>
                            <th>Product Details</th>
                            <th>Price</th>
                            <th class="text-center">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1; 
                        if(mysqli_num_rows($products) > 0) :
                            while($row = mysqli_fetch_assoc($products)) : 
                        ?>
                        <tr>
                            <td class="fw-bold text-muted" style="font-size: 0.8rem;">
                                <?= str_pad($i++, 2, "0", STR_PAD_LEFT); ?>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="product-dot"></div>
                                    <div>
                                        <div class="fw-bold text-dark text-uppercase small" style="letter-spacing: 0.5px;"><?= $row['name']; ?></div>
                                        <small class="text-muted fw-bold" style="font-size: 0.65rem;">STOCK: <?= $row['stock']; ?> UNITS</small>
                                    </div>
                                </div>
                            </td>
                            <td class="fw-bold text-muted" style="font-size: 0.9rem;">
                                Rp <?= number_format($row['price'], 0, ',', '.'); ?>
                            </td>
                            <td class="text-center">
                                <a href="edit.php?id=<?= $row['id']; ?>" class="text-muted fw-bold text-decoration-none small me-3" style="font-size: 0.7rem;">EDIT</a>
                                <a href="delete.php?id=<?= $row['id']; ?>" class="text-danger fw-bold text-decoration-none small" style="font-size: 0.7rem; opacity: 0.6;" onclick="return confirm('Archive this style?')">REMOVE</a>
                            </td>
                        </tr>
                        <?php 
                            endwhile; 
                        else: 
                        ?>
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted small italic">No items found in this category.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>