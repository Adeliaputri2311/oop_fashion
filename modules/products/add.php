<?php 
require '../../session_check.php';
require '../../config/database.php';

// Ambil data kategori untuk dropdown
$categories = mysqli_query($conn, "SELECT * FROM categories ORDER BY category_name ASC");

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $category_id = $_POST['category_id'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    $query = "INSERT INTO products (name, category_id, price, stock) 
              VALUES ('$name', '$category_id', '$price', '$stock')";

    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Produk berhasil ditambahkan ke koleksi! ✨');
                window.location.href = 'index.php'; 
              </script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Style - Jenstore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --primary-rose: #ff758f; --bg-body: #fdfafb; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--bg-body); color: #2d2327; }

        /* Sidebar & Layout */
        .sidebar-wrapper { width: 280px; height: 100vh; position: fixed; padding: 20px; z-index: 1000; }
        .main-content { margin-left: 280px; padding: 50px 40px; }

        /* Judul Cantik */
        .page-title {
            font-weight: 800;
            letter-spacing: -1.5px;
            font-size: 2.5rem;
            background: linear-gradient(45deg, #ff758f, #ffafbd);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Form Card */
        .glass-card { 
            background: white; 
            border: none; 
            border-radius: 35px; 
            box-shadow: 0 15px 35px rgba(255, 117, 143, 0.05); 
            overflow: hidden; 
            border: 1px solid rgba(255, 255, 255, 0.8);
        }
        
        .form-label { font-weight: 700; color: #4a4a4a; font-size: 0.85rem; letter-spacing: 0.5px; }
        .form-control, .form-select { 
            border-radius: 15px; 
            padding: 12px 20px; 
            border: 1px solid #f1f1f1; 
            background: #fdfafb;
            font-weight: 600;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-rose);
            box-shadow: 0 0 0 4px rgba(255, 117, 143, 0.1);
            background: white;
        }

        .btn-save { 
            background: #2d2327; 
            color: white; 
            border-radius: 15px; 
            padding: 12px 35px; 
            font-weight: 700; 
            border: none; 
            transition: 0.3s; 
        }
        .btn-save:hover { 
            background: var(--primary-rose); 
            transform: translateY(-2px); 
            box-shadow: 0 8px 20px rgba(255, 117, 143, 0.2); 
            color: white;
        }
    </style>
</head>
<body>

    <?php include '../../sidebar.php'; ?>

    <div class="main-content">
        <div class="row align-items-center mb-5">
            <div class="col">
                <h1 class="page-title">Add New Style</h1>
                <p class="text-muted">Create your next fashion masterpiece ✨</p>
            </div>
        </div>

        <div class="glass-card p-5">
            <form action="" method="POST">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label text-uppercase">Product Name</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. Silk Floral Dress" required>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label text-uppercase">Collection Category</label>
                        <select name="category_id" class="form-select" required>
                            <option value="" selected disabled>-- Select Category --</option>
                            <?php while($cat = mysqli_fetch_assoc($categories)) : ?>
                                <option value="<?= $cat['id']; ?>"><?= $cat['category_name']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label text-uppercase">Price (IDR)</label>
                        <input type="number" name="price" class="form-control" placeholder="0" required>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label text-uppercase">Stock Availability</label>
                        <input type="number" name="stock" class="form-control" placeholder="0" required>
                    </div>
                </div>
                
                <div class="d-flex justify-content-end gap-3 mt-4">
                    <a href="index.php" class="btn btn-light px-4 rounded-4 fw-bold text-muted" style="border-radius: 15px;">Cancel</a>
                    <button type="submit" name="submit" class="btn btn-save shadow-sm">Save to Collections</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>