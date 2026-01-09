# Fashion Store Management System

## Deskripsi Proyek
Sistem Manajemen Toko Fashion adalah aplikasi web yang dibangun menggunakan **PHP 8.0+** murni (tanpa framework). Sistem ini memungkinkan pengelolaan produk fashion, kategori, pelanggan, dan transaksi.

## Persyaratan Sistem
- **PHP**: 8.0 atau lebih baru
- **Database**: MySQL 5.7+ atau MariaDB 10.0+
- **Web Server**: Apache/Nginx dengan mod_rewrite
- **Browser**: Modern browser dengan JavaScript enabled

## Fitur PHP 8 yang Digunakan
- **Strict Types**: `declare(strict_types=1)` untuk type safety
- **Union Types**: Type hints yang lebih presisi
- **Named Parameters**: Parameter bernama untuk PDO connection
- **Nullsafe Operator**: Operator `?->` untuk safe property access
- **Attributes**: Metadata untuk kode yang lebih bersih
- **Match Expression**: Control structure yang lebih powerful
- **Constructor Property Promotion**: Syntax yang lebih ringkas

## Struktur Folder
```
fashion-store/
├── assets/                     # File statis
│   ├── css/
│   │   └── style.css           # Custom CSS
│   ├── js/
│   │   └── script.js           # Custom Javascript
│   └── img/                    # Foto produk fashion
├── config/                     # Konfigurasi sistem
│   ├── connection.php          # Koneksi ke Database MySQL
│   ├── query_builder.php       # Fungsi insert, update, delete, select
│   └── session.php             # Cek status login user
├── includes/                   # Potongan HTML yang dipakai berulang
│   ├── header.php              # Bagian atas (Navbar & Head)
│   └── footer.php              # Bagian bawah (Copyright & Scripts)
├── modules/                    # Logika CRUD per modul
│   ├── auth/                   # Proses login & registrasi
│   │   └── logout.php          # Proses logout
│   ├── products/               # Proses CRUD Produk
│   │   └── delete.php          # Hapus produk
│   ├── categories/             # Proses CRUD Kategori
│   └── transactions/           # Proses Transaksi
├── views/                      # Halaman tampilan user/admin
│   ├── auth/
│   │   ├── login.php           # Form login
│   │   └── register.php        # Form registrasi
│   ├── products/
│   │   ├── index.php           # Menampilkan Tabel Produk
│   │   ├── create.php          # Form Tambah Produk
│   │   └── edit.php            # Form Ubah Produk
│   └── dashboard.php           # Halaman utama setelah login
├── index.php                   # Landing page atau redirect ke login
├── database.sql                # File SQL (Tabel & Dummy Data)
└── README.md                   # Panduan penggunaan proyek
```

## Fitur Utama
- **Login & Registrasi**: Sistem autentikasi pengguna
- **Manajemen Produk**: Tambah, edit, hapus, dan tampilkan produk
- **Manajemen Kategori**: Kelola kategori produk
- **Manajemen Pelanggan**: Kelola data pelanggan
- **Manajemen Transaksi**: Kelola transaksi dan status
- **Dashboard**: Ringkasan statistik sistem
- **Session Management**: Pengelolaan sesi pengguna

## Teknologi yang Digunakan
- **Frontend**: HTML5, CSS3, JavaScript (ES6)
- **Backend**: PHP 7+ (tanpa framework)
- **Database**: MySQL
- **Styling**: CSS murni dengan sedikit library (jika diperlukan)

## Instalasi dan Setup

### 1. Persiapan Database
1. Buat database MySQL baru dengan nama `fashion_store`
2. Import file `database.sql` untuk membuat tabel dan data dummy

### 2. Konfigurasi Database
Edit file `config/connection.php` dan sesuaikan konfigurasi database:
```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'fashion_store');
define('DB_USER', 'root'); // Ganti dengan username MySQL Anda
define('DB_PASS', ''); // Ganti dengan password MySQL Anda
```

### 3. Menjalankan Aplikasi
1. Pastikan server web (Apache/Nginx) dan MySQL berjalan
2. Akses aplikasi melalui browser: `http://localhost/fashion-store/`
3. Login dengan akun default:
   - Username: `admin`
   - Password: `password`

## Panduan Penggunaan

### Login
1. Akses halaman login melalui `views/auth/login.php`
2. Masukkan username dan password
3. Klik "Login"

### Registrasi
1. Klik link "Register here" di halaman login
2. Isi form registrasi
3. Klik "Register"

### Manajemen Produk
1. Login sebagai admin atau user
2. Akses `views/products/index.php`
3. Untuk menambah produk: Klik "Add New Product"
4. Untuk edit/hapus: Klik link "Edit" atau "Delete" pada tabel produk

### Manajemen Kategori
1. Login sebagai admin
2. Akses halaman kategori (akan dikembangkan)
3. Kelola kategori sesuai kebutuhan

### Manajemen Pelanggan
1. Login sebagai admin
2. Akses halaman pelanggan (akan dikembangkan)
3. Kelola data pelanggan

### Manajemen Transaksi
1. Login sebagai admin
2. Akses halaman transaksi (akan dikembangkan)
3. Lihat dan kelola transaksi

## Pengembang
- Kelompok: [Nama Kelompok]
- Anggota: [Daftar Anggota]

## Lisensi
Proyek ini dibuat untuk keperluan akademik.