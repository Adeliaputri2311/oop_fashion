<?php
require '../../session_check.php';
require '../../config/database.php';

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM products WHERE id = '$id'");
$product = mysqli_fetch_assoc($query);

// Ambil kategori untuk dropdown
$categories = mysqli_query($conn, "SELECT * FROM categories");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Style | Jenstore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --primary-rose: #ff758f; --bg-body: #fdfafb; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--bg-body); color: #2d2327; }
        .main-content { margin-left: 280px; padding: 50px 40px; }
        .glass-card { background: white; border-radius: 30px; border: none; box-shadow: 0 10px 40px rgba(0,0,0,0.03); padding: 40px; }
        .form-control, .form-select { border-radius: 15px; padding: 12px 20px; border: 1px solid #eee; background: #fdfafb; }
        .btn-save { background: #2d2327; color: white; border-radius: 15px; padding: 12px 30px; font-weight: 700; border: none; }
        .btn-save:hover { background: var(--primary-rose); color: white; }
    </style>
</head>
<body>
    <?php include '../../sidebar.php'; ?>
    <div class="main-content">
        <div class="mb-5">
            <h1 class="fw-800" style="letter-spacing: -1.5px;">Edit Style</h1>
            <p class="text-muted">Update your product details here.</p>
        </div>

        <div class="glass-card col-md-8">
            <form action="update.php" method="POST">
                <input type="hidden" name="id" value="<?= $product['id']; ?>">
                
                <div class="mb-4">
                    <label class="form-label fw-bold small text-muted">PRODUCT NAME</label>
                    <input type="text" name="name" class="form-control" value="<?= $product['name']; ?>" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-bold small text-muted">CATEGORY</label>
                        <select name="category_id" class="form-select" required>
                            <?php while($cat = mysqli_fetch_assoc($categories)) : ?>
                                <option value="<?= $cat['id']; ?>" <?= ($cat['id'] == $product['category_id']) ? 'selected' : ''; ?>>
                                    <?= $cat['category_name']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-bold small text-muted">PRICE (Rp)</label>
                        <input type="number" name="price" class="form-control" value="<?= $product['price']; ?>" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold small text-muted">STOCK QUANTITY</label>
                    <input type="number" name="stock" class="form-control" value="<?= $product['stock']; ?>" required>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-save shadow-sm">Save Changes</button>
                    <a href="index.php" class="btn btn-light rounded-pill px-4 ms-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>