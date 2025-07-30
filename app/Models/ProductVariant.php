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
}
