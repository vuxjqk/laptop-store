<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductApplication extends Model
{
    protected $fillable = [
        'product_id',
        'application_id',
    ];
}
