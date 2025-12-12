# Thriftsy - E-Commerce Platform untuk Baju Preloved & Thrift

Thriftsy adalah platform e-commerce yang dirancang khusus untuk jual-beli baju preloved dan thrift. Platform ini memungkinkan seller untuk membuka toko online mereka sendiri dan buyer untuk menemukan produk fashion preloved berkualitas dengan harga terjangkau.

## 👥 Anggota Kelompok

**Kelompok 12 - PTI-B**

| Nama | NIM |
|------|-----|
| Muhammad Rasyid Ridho | 245150600111003 |
| Faturahman Gandi Ariyanto | 245150607111016 |

## 📋 Deskripsi Aplikasi

Thriftsy adalah marketplace yang menghubungkan penjual dan pembeli produk fashion preloved. Aplikasi ini menyediakan fitur lengkap untuk manajemen toko, produk, transaksi, dan sistem pembayaran yang terintegrasi.

### Fitur Utama

#### 🛍️ Untuk Buyer (Member)
- **Browse & Search**: Mencari produk berdasarkan kategori, nama, atau toko
- **Product Detail**: Melihat detail produk lengkap dengan gambar, deskripsi, dan harga
- **Shopping Cart**: Menambahkan produk ke keranjang belanja
- **Checkout**: Proses pembelian dengan metode pembayaran wallet atau COD
- **Top-up Wallet**: Mengisi saldo untuk pembayaran
- **Order Tracking**: Melihat status pesanan dan nomor resi pengiriman
- **Store Profile**: Mengunjungi halaman toko untuk melihat produk dari seller tertentu

#### 🏪 Untuk Seller
- **Store Management**: Membuat dan mengelola profil toko (nama, logo, deskripsi, kontak)
- **Product Management**: Menambah, edit, dan hapus produk dengan multiple images
- **Order Management**: Melihat dan memproses pesanan masuk
- **Shipping**: Input nomor resi untuk pesanan yang sudah dibayar
- **Balance & Withdrawal**: Melihat saldo dan melakukan penarikan dana
- **Dashboard**: Statistik penjualan dan ringkasan toko

#### 👨‍💼 Untuk Admin
- **Store Verification**: Verifikasi toko baru yang mendaftar
- **Withdrawal Approval**: Menyetujui atau menolak permintaan penarikan dana seller
- **User Management**: Mengelola data user dan toko
- **Dashboard**: Overview sistem dan statistik platform

## 🛠️ Teknologi yang Digunakan

### Backend
- **Framework**: Laravel 12.x
- **Database**: MySQL
- **Authentication**: Laravel Breeze
- **Storage**: Laravel Storage (untuk upload gambar)

### Frontend
- **CSS Framework**: Tailwind CSS
- **Template Engine**: Blade
- **JavaScript**: Vanilla JS (untuk interaktivitas)
- **Icons**: SVG Icons & Heroicons

### Additional Libraries
- **Image Processing**: Intervention Image (optional)
- **Pagination**: Laravel Pagination
- **Validation**: Laravel Validation

## 📦 Instalasi

### Prasyarat
- PHP >= 8.2
- Composer
- MySQL/MariaDB
- Node.js & NPM (untuk Vite)

### Langkah Instalasi

1. **Clone Repository**
   ```bash
   git clone https://github.com/raysyid/E-Commerce-PEMWEB-UAP-2025-12.git
   cd E-Commerce-PEMWEB-UAP-2025-12
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Configuration**
   
   Edit file `.env` dan sesuaikan konfigurasi database:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=thriftsy
   DB_USERNAME=your_database_username
   DB_PASSWORD=your_database_password
   ```

5. **Run Migrations & Seeders**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Storage Link**
   ```bash
   php artisan storage:link
   ```

7. **Build Assets**
   ```bash
   npm run dev
   ```

8. **Run Application**
   ```bash
   php artisan serve
   ```

   Aplikasi akan berjalan di `http://127.0.0.1:8000`

## 👤 Default Users (Seeder)

Setelah menjalankan seeder, Anda dapat login dengan akun berikut:

| Role | Email | Password |
|------|-------|----------|
| Admin | admin1@gmail.com | admin123 |
| Seller | lona@gmail.com | lona123 |
| Member | agus@gmail.com | agus |

## 🗂️ Struktur Database

### Tabel Utama

- **users**: Data pengguna (admin, seller, member)
- **stores**: Data toko seller
- **products**: Data produk yang dijual
- **product_images**: Gambar produk (multiple images per product)
- **product_categories**: Kategori produk
- **transactions**: Data transaksi pembelian
- **transaction_details**: Detail item dalam transaksi
- **user_balances**: Saldo wallet user
- **balance_histories**: Riwayat transaksi saldo
- **withdrawals**: Permintaan penarikan dana seller

## 🎨 Fitur Unggulan

### 1. Multi-Image Product
Setiap produk dapat memiliki multiple images dengan satu thumbnail utama.

### 2. Wallet System
Sistem wallet terintegrasi untuk top-up, pembayaran, dan withdrawal.

### 3. Store Verification
Admin dapat memverifikasi toko sebelum dapat mulai berjualan.

### 4. Order Tracking
Buyer dapat melacak pesanan dengan nomor resi yang diinput seller.

### 5. Responsive Design
UI yang responsive dan mobile-friendly dengan Tailwind CSS.

### 6. Search & Filter
Pencarian produk dengan filter kategori dan toko.

## 📱 Screenshots

### Landing Page
Halaman utama dengan featured products dan recommended stores.

### Product Detail
Detail produk lengkap dengan gambar, deskripsi, dan tombol beli.

### Seller Dashboard
Dashboard seller dengan statistik penjualan dan manajemen produk.

### Admin Panel
Panel admin untuk verifikasi toko dan approval withdrawal.

## 🔐 Security Features

- Password hashing dengan bcrypt
- CSRF protection
- SQL injection prevention (Eloquent ORM)
- XSS protection
- File upload validation (MIME type & size)
- Role-based access control

## 🚀 Future Improvements

- [ ] Payment gateway integration (Midtrans, etc.)
- [ ] Real-time notifications
- [ ] Chat system antara buyer dan seller
- [ ] Rating & review system
- [ ] Wishlist feature
- [ ] Advanced analytics dashboard
- [ ] Email notifications
- [ ] Social media integration

## 📝 License

This project is created for educational purposes as part of Web Programming course assignment.

## 🤝 Contributing

This is an academic project. For any questions or suggestions, please contact the team members.

## 📧 Contact

- Muhammad Rasyid Ridho - 245150600111003
- Faturahman Gandi Ariyanto - 245150607111016

---

**Universitas Brawijaya**  
**Fakultas Ilmu Komputer**  
**Pemrograman Web - UAP 2025**  
**Kelompok 12 - PTI-B**
