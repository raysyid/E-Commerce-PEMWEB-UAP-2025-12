<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class SyncProductImages extends Command
{
    protected $signature = 'images:sync';
    protected $description = 'Copy sample product images dari public ke storage';

    public function handle()
    {
        $source = public_path('sample-products');
        $destination = storage_path('app/public/products');

        if (!File::exists($source)) {
            $this->error('❌ Folder public/sample-products tidak ditemukan');
            return false;
        }

        // buat folder tujuan jika belum ada
        if (!File::exists($destination)) {
            File::makeDirectory($destination, 0777, true);
        }

        // copy semua file
        $files = File::allFiles($source);

        foreach ($files as $file) {
            File::copy($file->getPathname(), $destination . '/' . $file->getFilename());
        }

        $this->info('✔ Semua gambar berhasil disalin ke storage/products');
        $this->info('📌 Pastikan menjalankan: php artisan storage:link (hanya sekali saja)');
        return true;
    }
}