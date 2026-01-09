<?php
// Deteksi halaman aktif agar kotak pink otomatis berpindah
$current_url = $_SERVER['REQUEST_URI'];
?>

<style>
    :root { --primary-rose: #ff758f; }
    .sidebar-wrapper { width: 280px; height: 100vh; position: fixed; padding: 20px; z-index: 1000; }
    .sidebar-content { background: white; height: 100%; border-radius: 30px; box-shadow: 0 10px 40px rgba(255,117,143,0.08); padding: 30px 20px; display: flex; flex-direction: column; border: 1px solid rgba(255,255,255,0.5); }
    .brand-section { padding: 0 15px 40px; font-weight: 800; font-size: 1.4rem; background: linear-gradient(45deg, #ff758f, #c9184a); -webkit-background-clip: text; -webkit-text-fill-color: transparent; text-decoration: none; display: block; }
    .nav-menu { list-style: none; padding: 0; width: 100%; }
    .nav-link-custom { display: flex; align-items: center; padding: 14px 20px; text-decoration: none; color: #8a8184; font-weight: 600; border-radius: 18px; transition: 0.3s; margin-bottom: 8px; }
    .nav-link-custom:hover { background: #fff0f3; color: var(--primary-rose); transform: translateX(5px); }
    .nav-link-custom.active { background: var(--primary-rose); color: white !important; box-shadow: 0 8px 20px rgba(255, 117, 143, 0.3); }
    .nav-icon { margin-right: 12px; font-size: 1.2rem; }
    .main-content { margin-left: 280px; padding: 40px; }
</style>

<div class="sidebar-wrapper">
    <div class="sidebar-content d-flex flex-column">
        <a href="/fashion-app/index.php" class="brand-section">JENSTORE.</a>
        
        <ul class="nav-menu flex-grow-1">
            <li class="nav-item">
                <a href="/fashion-app/index.php" 
                   class="nav-link-custom <?= (basename($current_url) == 'index.php' && !strpos($current_url, 'modules')) ? 'active' : '' ?>">
                    <span class="nav-icon">🏠</span> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="/fashion-app/modules/products/index.php" 
                   class="nav-link-custom <?= (strpos($current_url, 'modules/products') !== false) ? 'active' : '' ?>">
                    <span class="nav-icon">🛍️</span> Collections
                </a>
            </li>
            <li class="nav-item">
                <a href="/fashion-app/modules/categories/index.php" 
                class="nav-link-custom <?= (strpos($current_url, 'modules/categories') !== false) ? 'active' : '' ?>">
                    <span class="nav-icon">🎀</span> Categories
                </a>
            </li>
            <li class="nav-item">
                <a href="/fashion-app/modules/orders/index.php" 
                class="nav-link-custom <?= (strpos($current_url, 'modules/orders') !== false) ? 'active' : '' ?>">
                    <span class="nav-icon">🧾</span> Orders
                </a>
            </li>
        </ul>

        <div class="user-section mt-auto">
            <div class="p-3 rounded-4 bg-light mb-3">
                <small class="text-muted d-block" style="font-size: 0.7rem;">LOGGED IN AS</small>
                <strong style="color: var(--primary-rose)"><?= strtoupper($_SESSION['username']); ?></strong>
            </div>
            <a href="/fashion-app/modules/auth/logout.php" class="nav-link-custom text-danger">
                <span class="nav-icon">🚪</span> Logout
            </a>
        </div>
    </div>
</div>