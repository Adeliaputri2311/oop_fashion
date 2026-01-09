<?php 
require '../../session_check.php';
require '../../config/database.php';

// Ambil data produk
$products_query = mysqli_query($conn, "SELECT products.*, categories.category_name 
                            FROM products 
                            LEFT JOIN categories ON products.category_id = categories.id 
                            WHERE stock > 0 ORDER BY name ASC");
$products = [];
while($p = mysqli_fetch_assoc($products_query)) {
    $products[] = $p;
}

if (isset($_POST['save_order'])) {
    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $cart_data = json_decode($_POST['cart_json'], true);
    $final_total = $_POST['final_total'];

    if (!empty($cart_data)) {
        mysqli_query($conn, "INSERT INTO orders (customer_name, total_price) VALUES ('$customer_name', '$final_total')");
        $order_id = mysqli_insert_id($conn);

        foreach ($cart_data as $item) {
            $p_id = $item['id'];
            $qty = $item['qty'];
            $subtotal = $item['price'] * $qty;
            mysqli_query($conn, "INSERT INTO order_details (order_id, product_id, quantity, subtotal) 
                                VALUES ('$order_id', '$p_id', '$qty', '$subtotal')");
            mysqli_query($conn, "UPDATE products SET stock = stock - $qty WHERE id = '$p_id'");
        }
        echo "<script>alert('Transaksi Berhasil Disimpan! ✨'); window.location.href = 'index.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Checkout | Jenstore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --primary-rose: #ff758f; --soft-pink: #fff0f3; --bg-body: #fdfafb; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--bg-body); overflow-x: hidden; }
        
        .main-content { margin-left: 280px; padding: 40px; }
        
        /* Katalog Area */
        .catalog-container { height: calc(100vh - 180px); overflow-y: auto; padding-right: 10px; }
        .catalog-container::-webkit-scrollbar { width: 5px; }
        .catalog-container::-webkit-scrollbar-thumb { background: #eee; border-radius: 10px; }

        .product-card { 
            background: white; border-radius: 22px; padding: 20px; transition: 0.3s; 
            border: 1px solid #f0f0f0; cursor: pointer; position: relative;
        }
        .product-card:hover { border-color: var(--primary-rose); transform: translateY(-5px); box-shadow: 0 10px 25px rgba(255, 117, 143, 0.1); }
        .product-card .price { font-weight: 800; font-size: 1.1rem; color: #2d2327; }
        
        /* Cart Area */
        .cart-container { 
            background: white; border-radius: 30px; padding: 30px; 
            box-shadow: 0 10px 40px rgba(0,0,0,0.03); border: 1px solid #fff;
            height: fit-content; position: sticky; top: 40px;
        }

        .cart-item {
            background: #fffafa; border-radius: 15px; padding: 12px 15px; 
            margin-bottom: 10px; border: 1px solid #fff0f3;
        }

        .btn-checkout { 
            background: #2d2327; color: white; border-radius: 18px; width: 100%; 
            padding: 16px; font-weight: 700; border: none; transition: 0.3s;
        }
        .btn-checkout:hover { background: var(--primary-rose); box-shadow: 0 10px 20px rgba(255, 117, 143, 0.3); }
        
        .empty-cart-img { width: 60px; opacity: 0.3; margin-bottom: 15px; }
    </style>
</head>
<body>
    <?php include '../../sidebar.php'; ?>

    <div class="main-content">
        <div class="row">
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="fw-800 mb-1" style="letter-spacing: -1.5px;">Market Selection</h2>
                        <p class="text-muted small mb-0">Klik produk untuk menambahkan ke pesanan.</p>
                    </div>
                </div>
                
                <div class="catalog-container">
                    <div class="row g-3">
                        <?php foreach($products as $p) : ?>
                        <div class="col-md-4">
                            <div class="product-card" onclick="addToCart(<?= $p['id']; ?>, '<?= $p['name']; ?>', <?= $p['price']; ?>, <?= $p['stock']; ?>)">
                                <span class="badge mb-2" style="background: var(--soft-pink); color: var(--primary-rose); border-radius: 8px;">
                                    <?= strtoupper($p['category_name'] ?? 'General'); ?>
                                </span>
                                <div class="fw-bold text-dark mb-1 h6 text-truncate"><?= $p['name']; ?></div>
                                <div class="price">Rp <?= number_format($p['price'], 0, ',', '.'); ?></div>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <small class="text-muted">Stock: <b><?= $p['stock']; ?></b></small>
                                    <span class="text-rose fw-bold small" style="color: var(--primary-rose)">+ Add</span>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="cart-container">
                    <div class="d-flex align-items-center mb-4">
                        <span class="fs-4 me-2">🛍️</span>
                        <h4 class="fw-800 mb-0">Order Cart</h4>
                    </div>

                    <form action="" method="POST" id="finalForm">
                        <div class="mb-4">
                            <label class="small fw-bold text-muted mb-2">CUSTOMER NAME</label>
                            <input type="text" name="customer_name" id="customer_name" class="form-control border-light shadow-sm py-2" placeholder="Masukan Nama.." required style="border-radius: 12px;">
                        </div>

                        <label class="small fw-bold text-muted mb-2">ITEMS</label>
                        <div id="cart-items" style="max-height: 300px; overflow-y: auto;">
                            <div class="text-center py-5">
                                <img src="https://cdn-icons-png.flaticon.com/512/11329/11329060.png" class="empty-cart-img">
                                <p class="text-muted small">Keranjang masih kosong</p>
                            </div>
                        </div>

                        <div class="bg-light p-3 rounded-4 mb-4 mt-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted small fw-bold">TOTAL PEMBAYARAN</span>
                                <span class="fw-800 fs-4" id="display-total" style="color: #2d2327;">Rp 0</span>
                            </div>
                        </div>

                        <input type="hidden" name="cart_json" id="cart_json">
                        <input type="hidden" name="final_total" id="final_total">
                        <button type="submit" name="save_order" class="btn-checkout">Complete Transaction</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let cart = [];

        function addToCart(id, name, price, stock) {
            const existingItem = cart.find(item => item.id === id);
            if (existingItem) {
                if (existingItem.qty < stock) {
                    existingItem.qty += 1;
                } else {
                    alert('Maaf, stok sudah habis untuk item ini!');
                }
            } else {
                cart.push({ id, name, price, qty: 1 });
            }
            renderCart();
        }

        function updateQty(id, delta) {
            const item = cart.find(i => i.id === id);
            if (item) {
                item.qty += delta;
                if (item.qty <= 0) removeFromCart(id);
            }
            renderCart();
        }

        function removeFromCart(id) {
            cart = cart.filter(item => item.id !== id);
            renderCart();
        }

        function renderCart() {
            const cartDiv = document.getElementById('cart-items');
            const displayTotal = document.getElementById('display-total');
            const cartJsonInput = document.getElementById('cart_json');
            const finalTotalInput = document.getElementById('final_total');
            
            if (cart.length === 0) {
                cartDiv.innerHTML = `<div class="text-center py-5"><img src="https://cdn-icons-png.flaticon.com/512/11329/11329060.png" class="empty-cart-img"><p class="text-muted small">Keranjang masih kosong</p></div>`;
                displayTotal.innerText = 'Rp 0';
                return;
            }

            let html = '';
            let total = 0;

            cart.forEach(item => {
                const subtotal = item.price * item.qty;
                total += subtotal;
                html += `
                    <div class="cart-item">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div class="fw-bold small text-truncate" style="max-width: 150px;">${item.name}</div>
                            <div class="fw-bold small">Rp ${subtotal.toLocaleString('id-ID')}</div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">Rp ${item.price.toLocaleString('id-ID')}</small>
                            <div class="d-flex align-items-center bg-white rounded-pill border px-2">
                                <button type="button" class="btn btn-sm p-0 px-2 fw-bold text-muted" onclick="updateQty(${item.id}, -1)">-</button>
                                <span class="mx-2 small fw-bold">${item.qty}</span>
                                <button type="button" class="btn btn-sm p-0 px-2 fw-bold text-rose" style="color:var(--primary-rose)" onclick="updateQty(${item.id}, 1)">+</button>
                            </div>
                        </div>
                    </div>
                `;
            });

            cartDiv.innerHTML = html;
            displayTotal.innerText = 'Rp ' + total.toLocaleString('id-ID');
            cartJsonInput.value = JSON.stringify(cart);
            finalTotalInput.value = total;
        }
    </script>
</body>
</html>