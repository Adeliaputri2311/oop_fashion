-- 1. Membuat Database
CREATE DATABASE IF NOT EXISTS fashion_db;
USE fashion_db;

-- 2. Membuat Tabel Categories
-- Nama kolom diubah dari 'name' menjadi 'category_name' sesuai index.php baris 6
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(50) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 3. Membuat Tabel Products
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    category_id INT,
    price INT NOT NULL DEFAULT 0,
    stock INT NOT NULL DEFAULT 0,
    image VARCHAR(255) DEFAULT 'default.jpg',
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_category FOREIGN KEY (category_id) 
        REFERENCES categories(id) ON DELETE SET NULL
);

-- 4. Membuat Tabel Users
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'customer') NOT NULL DEFAULT 'customer',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 5. Mengisi Data Awal (Disesuaikan dengan nama kolom baru)
INSERT INTO categories (category_name, description) VALUES 
('Atasan', 'Koleksi baju, kaos, dan kemeja'),
('Bawahan', 'Koleksi celana dan rok'),
('Aksesoris', 'Perhiasan dan pelengkap fashion');

INSERT INTO products (name, category_id, price, stock) VALUES 
('Kemeja Rose Satin', 1, 150000, 20),
('Celana Chino Slim Fit', 2, 250000, 15),
('Kalung Mutiara', 3, 75000, 50);

-- Password Admin: 'admin123' 
-- Sudah di-hash agar cocok dengan password_verify di auth_logic.php
INSERT INTO users (username, password, role) VALUES 
('admin', '$2y$10$89E9nS.5M7l.gGclpS66W.SdfpMph0Y9b9.Y5M1D0.5F67P.Y.Yy2', 'admin');