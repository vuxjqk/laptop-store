<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = [
        'product_id',
        'ram_id',
        'storage_id',
        'color_id',
        'price',
        'original_price',
        'stock_quantity',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function ram()
    {
        return $this->belongsTo(Ram::class);
    }

    public function storage()
    {
        return $this->belongsTo(Storage::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }
}
