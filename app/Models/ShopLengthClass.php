<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class ShopLengthClass extends Model
{
    use HasFactory;
    
    protected $table = 'shop_length_class';

    protected $fillable = [
        'name',
        'description',
    ];
}
