<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class ShopSupplier extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'shop_suppliers';

    protected $fillable = [
        'name',
        'alias',
        'email',
        'phone',
        'image',
        'address',
        'url',
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

    public function products()
    {
        return $this->hasMany(\App\Models\ShopProduct::class, 'supplier_id', 'id');
    }
}
