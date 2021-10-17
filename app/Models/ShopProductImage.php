<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopProductImage extends Model
{
    use HasFactory;

    protected $table = 'shop_product_images';

    protected $fillable = [
        'image',
        'product_id',
    ];
}
