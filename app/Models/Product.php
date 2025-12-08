<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'store_id',
        'product_category_id',
        'name',
        'slug',
        'description',
        'condition',
        'price',
        'weight',
        'stock',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    // alias readable (1)
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    // relasi asli (2)
    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    // alias readable (3)
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    // relasi asli (4)
    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function productReviews()
    {
        return $this->hasMany(ProductReview::class);
    }
}