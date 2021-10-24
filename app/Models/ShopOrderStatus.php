<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopOrderStatus extends Model
{
    use HasFactory;

    protected $table = 'shop_order_status';

    protected $fillable = [
        'name',
    ];

    public function orders()
    {
        return $this->hasMany(\App\Models\ShopOrder::class, 'status', 'id');
    }
}
