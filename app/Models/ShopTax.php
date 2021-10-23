<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class ShopTax extends Model
{
    use HasFactory;

    protected $table = 'shop_tax';

    protected $fillable = [
        'name',
        'value'
    ];
}
