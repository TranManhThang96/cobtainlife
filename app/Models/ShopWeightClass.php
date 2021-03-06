<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopWeightClass extends Model
{
    use HasFactory;

    protected $table = 'shop_weight_class';

    protected $fillable = [
        'name',
        'description',
    ];
}
