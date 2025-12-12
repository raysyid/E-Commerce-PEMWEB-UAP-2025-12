# Setup Gambar Produk Seeder

## Lokasi Gambar

### Produk Seeder (untuk git)
- **Folder**: `public/assets/products-seed/`
- **Contoh**: `handbag1.webp`, `cifon1.webp`, dll
- Gambar ini akan di-commit ke git

### Produk User Upload (tidak untuk git)
- **Folder**: `public/storage/products/`
- Gambar ini di-ignore oleh git (sudah ada di .gitignore)

## Cara Setup

### 1. Copy Gambar Seeder
Copy semua gambar produk seeder dari `public/storage/products/` ke `public/assets/products-seed/`:

```bash
# Windows PowerShell
Copy-Item "public\storage\products\*" -Destination "public\assets\products-seed\" -Force

# Linux/Mac
cp public/storage/products/* public/assets/products-seed/
```

### 2. Jalankan Seeder
```bash
php artisan db:seed --class=ProductSeeder
```

## Cara Kerja

ProductSeeder akan:
1. Prefix semua gambar dengan `seed-` (contoh: `seed-handbag1.webp`)
2. Simpan ke database dengan prefix tersebut

View akan:
1. Cek apakah image name dimulai dengan `seed-`
2. Jika ya → pakai path `assets/products-seed/` (tanpa prefix)
3. Jika tidak → pakai path `storage/products/`

## Daftar Gambar yang Dibutuhkan

Pastikan file-file ini ada di `public/assets/products-seed/`:
- handbag1.webp
- cifon1.webp
- closshi1.webp
- lace_midi1.webp
- roosy_kitty1.webp
- gap_hoodie1.webp
- sweater1.webp
- nike_p6000_1.webp
- chanel_gabrielle1.webp
- y2k_hoodie1.webp

## Store Logo
Store seeder juga butuh logo di `public/assets/store/`:
- lona.webp
