# Toko Saya 🛒

Aplikasi e-commerce sederhana yang dibangun dengan **Laravel 13**. Proyek ini dibuat sebagai portofolio untuk menunjukkan pemahaman saya tentang dasar-dasar pengembangan web modern, mulai dari CRUD, relasi database, hingga sistem autentikasi dan keranjang belanja.

## ✨ Fitur Utama
*   **Manajemen Produk (CRUD):** Menambah, melihat, mengedit, dan menghapus produk.
*   **Manajemen Kategori:** Mengelompokkan produk berdasarkan kategori (Relasi One-to-Many).
*   **Upload Gambar:** Mengunggah foto produk dan menggantinya (otomatis menghapus gambar lama).
*   **Autentikasi & Otorisasi:** Sistem Login/Register menggunakan Laravel Breeze. Terdapat dua role: **Admin** (mengelola toko) dan **Pembeli** (berbelanja).
*   **Keranjang Belanja (Cart):** Menambahkan produk ke keranjang, mengubah quantity, dan menghapus item menggunakan Session.
*   **Checkout & Simulasi Pembayaran:** Halaman checkout dengan pilihan metode pembayaran (Transfer Bank, E-Wallet, COD, dan simulasi QRIS).
*   **Desain Modern:** Antarmuka responsif menggunakan Tailwind CSS.

## 🛠️ Teknologi yang Digunakan
*   **Backend:** Laravel 13 (PHP)
*   **Database:** SQLite / MySQL
*   **Frontend:** Blade Templating, Tailwind CSS
*   **Build Tool:** Vite
*   **Version Control:** Git & GitHub

## 🚀 Cara Menjalankan Proyek
1. Clone repositori ini: `git clone https://github.com/hudayana/tokosaya1.git`
2. Masuk ke folder: `cd tokosaya1`
3. Install dependensi PHP: `composer install`
4. Copy file `.env.example` menjadi `.env`
5. Generate key: `php artisan key:generate`
6. Jalankan migrasi database: `php artisan migrate`
7. Install dependensi frontend: `npm install && npm run build`
8. Jalankan server: `php artisan serve`
9. Buka `http://127.0.0.1:8000` di browser.