# 🎀 Jenstore: Premium Fashion Management System

Jenstore adalah sistem informasi manajemen inventaris dan penjualan berbasis web yang dirancang khusus untuk butik fashion. Sistem ini mengintegrasikan pengelolaan stok dengan fitur transaksi kasir yang modern.



## ✨ Fitur Utama
Sistem ini mencakup fungsionalitas **CRUD** lengkap dengan 5 tabel database yang saling berelasi:

- **🔐 Premium Authentication**: Sistem Login dan Register yang aman menggunakan *Session* dan enkripsi password.
- **📊 Aesthetic Dashboard**: Ringkasan data real-time termasuk total item, jumlah kategori, dan **Inventory Value** (Total nilai aset).
- **👗 Collection Management**: Pengelolaan produk fashion dengan fitur filter kategori berbasis *Tabs* yang minimalis.
- **🏷️ Dynamic Categories**: Pengelompokan produk secara dinamis untuk memudahkan manajemen inventaris.
- **🛒 Smart Checkout (POS)**: Fitur kasir dengan keranjang belanja (Shopping Cart) interaktif dan fitur **Auto-Update Stock** saat transaksi berhasil.
- **🧾 Sales Orders**: Riwayat transaksi lengkap dengan rincian item yang dibeli.

## 🛠️ Teknologi yang Digunakan
- **PHP 8.3.26**: Logika server-side.
- **MySQL**: Penyimpanan data relasional (5 Tabel: `users`, `products`, `categories`, `orders`, `order_details`).
- **Bootstrap**: Untuk tampilan.
- **JavaScript**: Menangani kalkulator keranjang belanja secara real-time.
- **Google Fonts**: Plus Jakarta Sans untuk tipografi modern.



## 📂 Struktur Database (5 Tabel)
1. `users`: Menyimpan data akun admin.
2. `categories`: Menyimpan kelompok jenis fashion.
3. `products`: Menyimpan detail produk, harga, dan stok.
4. `orders`: Menyimpan data induk transaksi penjualan.
5. `order_details`: Menyimpan rincian item yang terjual di setiap transaksi.

## 🚀 Instalasi
1. **Clone/Download**: Masukkan folder project ke direktori `C:\laragon\www\fashion-app`.
2. **Database Setup**:
   - Buka Laragon, klik **Start All**.
   - Klik tombol **Database** (HeidiSQL atau phpMyAdmin).
   - Buat database baru dengan nama `fashion_app`.
   - Import file `sql/database.sql` ke dalam database tersebut.
3. **Configuration**: 
   - Buka file `config/database.php`.
   - Pastikan konfigurasi: `$host = "localhost"`, `$user = "root"`, `$pass = ""`.
4. **Access Project**:
   - Klik kanan pada Laragon -> **www** -> **fashion-app**.
   - Atau akses via browser di `http://fashion-app.test` (jika fitur virtual host aktif) atau `http://localhost/fashion-app`.

## 👥 Nama Kelompok
- **Adelia Putri** - 5520124034
- **Muhammad Rizkya Nasti** - 5520124054
- **Nicky Faliansyah** - 5520124056

---
*Dibuat dengan ❤️ untuk memenuhi tugas Project Sistem Informasi Fashion.*