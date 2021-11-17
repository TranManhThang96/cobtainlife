<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopConfig extends Model
{
    use HasFactory;

    protected $table = 'shop_configs';

    protected $fillable = [
        'code',
        'key',
        'value',
        'detail',
        'sort',
    ];
}
