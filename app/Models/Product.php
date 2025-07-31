<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'brand_id',
        'description',
        'processor',
        'display',
        'graphics',
        'battery',
        'weight',
        'ports',
        'is_active',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function features()
    {
        return $this->hasMany(ProductFeature::class);
    }
}
