<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
class ShopProductAttribute extends Model
{
    use HasFactory;
    
    protected $table = 'shop_product_attributes';

    protected $fillable = [
        'name',
        'attribute_group_id',
        'product_id',
        'add_price',
        'status',
        'sort',
        'created_by',
        'updated_by'
    ];

    public static function boot()
    {
       parent::boot();
       static::creating(function($model)
       {
           $user = Auth::guard('admin')->user();
           $model->created_by = $user->id;
           $model->updated_by = $user->id;
       });
       static::updating(function($model)
       {
           $user = Auth::guard('admin')->user();
           $model->updated_by = $user->id;
       });
    }

    public function shopAttributeGroup()
    {
        return $this->belongsTo(\App\Models\ShopAttributeGroup::class, 'attribute_group_id', 'id');
    }
}
