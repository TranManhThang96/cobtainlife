<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopShippingStatus extends Model
{
    use HasFactory;

    protected $table = 'shop_shipping_status';

    protected $fillable = [
        'name',
    ];

    public function orders()
    {
        return $this->hasMany(\App\Models\ShopOrder::class, 'shipping_status', 'id');
    }
}
