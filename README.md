# Toko Saya 🛒

Aplikasi e-commerce sederhana yang dibangun dengan **Laravel**. Proyek ini dibuat sebagai portofolio untuk menunjukkan pemahaman saya tentang dasar-dasar pengembangan web modern, mulai dari CRUD, relasi database, autentikasi, keranjang belanja, hingga sistem pemesanan.

## ✨ Fitur Utama

- **Manajemen Produk & Kategori (CRUD):** Admin dapat menambah, melihat, mengedit, dan menghapus produk beserta kategorinya.
- **Upload Gambar:** Mengunggah foto produk (otomatis menghapus gambar lama dari *storage*).
- **Autentikasi & Otorisasi:** Sistem Login/Register dengan dua role: **Admin** (mengelola toko) dan **Pembeli** (berbelanja).
- **Pencarian & Filter:** Mencari produk berdasarkan nama dan memfilter berdasarkan kategori.
- **Keranjang Belanja (Cart):** Menggunakan *Session* dengan sinkronisasi harga real-time dari database.
- **Checkout & Simulasi Pembayaran:** Input alamat pengiriman dan pilihan metode pembayaran (Transfer Bank, E-Wallet, COD, dan simulasi QRIS).
- **Riwayat Pesanan:** Admin dapat melihat daftar pesanan yang masuk beserta detail barang yang dipesan.

## 🛠️ Teknologi yang Digunakan

- **Backend:** Laravel 11/12/13 (PHP)
- **Database:** SQLite / MySQL
- **Frontend:** Blade Templating, Tailwind CSS
- **Build Tool:** Vite

## 🚀 Cara Menjalankan Proyek

1. Clone repositori ini: `git clone https://github.com/hudayana/tokosaya1.git`
2. Masuk ke folder: `cd tokosaya1`
3. Install dependensi PHP: `composer install`
4. Copy file `.env.example` menjadi `.env`
5. Generate key: `php artisan key:generate`
6. Jalankan migrasi database beserta seeder: `php artisan migrate:fresh --seed`
7. Install dependensi frontend: `npm install && npm run build`
8. Jalankan server: `php artisan serve`
9. Buka `http://127.0.0.1:8000` di browser.

## 🔑 Akun Testing (Seeder)

Gunakan akun ini untuk mencoba fitur:

**Admin:**
- Email: `admin@tokosaya.com`
- Password: `password123`

**Pembeli:**
- Email: `pembeli@tokosaya.com`
- Password: `password123`