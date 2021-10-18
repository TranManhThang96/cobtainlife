<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopPaymentStatus extends Model
{
    use HasFactory;

    protected $table = 'shop_payment_status';

    protected $fillable = [
        'name',
    ];

}
