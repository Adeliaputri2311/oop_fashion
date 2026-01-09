<?php 
require '../../session_check.php';
require '../../config/database.php';

// Urutan ASC agar sinkron dengan penomoran
$categories = mysqli_query($conn, "SELECT * FROM categories ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories Management | Jenstore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-rose: #ff758f;
            --soft-pink: #ffafbd;
            --bg-body: #fdfafb;
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-body);
            color: #4a4a4a;
        }

        .main-content {
            margin-left: 280px;
            padding: 50px 40px;
        }

        /* Header Title dengan warna Gradien Lembut */
        .page-title {
            font-weight: 800;
            letter-spacing: -1.5px;
            font-size: 2.5rem;
            background: linear-gradient(45deg, #ff758f, #ffafbd);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Input Group bergaya "Cloudy" */
        .input-group-modern {
            background: white;
            padding: 8px;
            border-radius: 25px; /* Lebih bulat agar cewe banget */
            box-shadow: 0 10px 25px rgba(255, 117, 143, 0.1);
            border: 1px solid rgba(255, 117, 143, 0.05);
        }

        .form-control-modern {
            border: none;
            padding-left: 20px;
            font-weight: 600;
            color: #666;
        }

        .form-control-modern:focus {
            box-shadow: none;
            background: transparent;
        }

        .btn-add-cat {
            background: linear-gradient(45deg, #ff758f, #ffafbd);
            color: white;
            border: none;
            border-radius: 20px;
            font-weight: 700;
            padding: 10px 25px;
            transition: 0.3s;
        }

        .btn-add-cat:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 117, 143, 0.3);
            color: white;
        }

        /* Card Tabel yang Clean & Aesthetic */
        .glass-card {
            background: white;
            border: none;
            border-radius: 35px; /* Super Rounded */
            box-shadow: 0 15px 35px rgba(0,0,0,0.02);
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.8);
        }

        .table thead th {
            background-color: #fff8f9;
            color: #a0a0a0;
            font-size: 0.75rem;
            letter-spacing: 1px;
            padding: 20px 25px;
        }

        /* Badge Kategori yang Soft */
        .category-badge {
            background: #fff0f3;
            color: var(--primary-rose);
            padding: 10px 20px;
            border-radius: 15px;
            font-weight: 700;
            font-size: 0.85rem;
            display: inline-block;
            border: 1px solid rgba(255, 117, 143, 0.1);
        }

        .btn-delete-text {
            color: #d1d1d1;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.8rem;
            transition: 0.3s;
            letter-spacing: 0.5px;
        }

        .btn-delete-text:hover {
            color: var(--primary-rose);
        }

        .number-box {
            color: #ffb3c1;
            font-weight: 800;
        }
    </style>
</head>
<body>

    <?php include '../../sidebar.php'; ?>

    <div class="main-content">
        <div class="row align-items-center mb-5">
            <div class="col-md-6">
                <h1 class="page-title">Categories</h1>
                <p class="text-muted mb-0">Atur kelompok koleksi cantikmu ✨</p>
            </div>
            <div class="col-md-6">
                <div class="input-group-modern">
                    <form action="process.php" method="POST" class="d-flex w-100">
                        <input type="text" name="category_name" class="form-control form-control-modern" placeholder="Nama kategori baru..." required>
                        <button type="submit" name="add_category" class="btn btn-add-cat">Add</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="glass-card">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-5 border-0" width="100">NO</th>
                        <th class="border-0">CATEGORY NAME</th>
                        <th class="text-center border-0 pe-5" width="200">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1; 
                    if(mysqli_num_rows($categories) > 0) :
                        while($row = mysqli_fetch_assoc($categories)) : 
                    ?>
                    <tr>
                        <td class="ps-5">
                            <span class="number-box"><?= str_pad($no++, 2, "0", STR_PAD_LEFT); ?></span>
                        </td> 
                        <td>
                            <span class="category-badge"><?= strtoupper($row['category_name']); ?></span>
                        </td>
                        <td class="text-center pe-5">
                            <a href="delete.php?id=<?= $row['id']; ?>" 
                               class="btn-delete-text" 
                               onclick="return confirm('Hapus kategori ini? 🌸')">
                               DELETE
                            </a>
                        </td>
                    </tr>
                    <?php 
                        endwhile; 
                    else: 
                    ?>
                    <tr>
                        <td colspan="3" class="text-center py-5 text-muted small">Koleksi kategori masih kosong...</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>