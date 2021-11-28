<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Enums\DBConstant;
class ShopProduct extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'shop_products';

    protected $fillable = [
        'name',
        'alias',
        'image',
        'keyword',
        'description',
        'content',
        'sku',
        'category_id',
        'brand_id',
        'supplier_id',
        'price',
        'cost',
        'stock',
        'weight_class',
        'weight',
        'length_class',
        'length',
        'width',
        'height',
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

    public function category()
    {
        return $this->belongsTo(\App\Models\ShopCategory::class, 'category_id', 'id');
    }

    public function brand()
    {
        return $this->belongsTo(\App\Models\ShopBrand::class, 'brand_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo(\App\Models\ShopSupplier::class, 'supplier_id', 'id');
    }

    public function promotion()
    {
        return $this->hasOne(\App\Models\ShopProductPromotion::class, 'product_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(\App\Models\ShopProductImage::class, 'product_id', 'id');
    }

    public function attributes()
    {
        return $this->hasMany(\App\Models\ShopProductAttribute::class, 'product_id', 'id');
    }

    public function orders()
    {
        return $this->belongsToMany(\App\Models\ShopOrder::class, 'shop_order_details', 'product_id' ,'order_id');
    }

    public function setContentAttribute($value)
    {
        $this->attributes['content'] = htmlspecialchars($value);
    }

    public function getContentAttribute($value): string
    {
        return auth('admin')->user() ? $value : htmlspecialchars_decode($value);
    }

    public function setCostAttribute($value)
    {
        $this->attributes['cost'] = convertStringToNumber($value);
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = convertStringToNumber($value);
    }

    public function comments()
    {
        return $this->hasMany(\App\Models\ShopComment::class, 'object_id', 'id')->where([
            ['type', DBConstant::PRODUCT_COMMENT],
            ['comment_parent', DBConstant::NO_COMMENT_PARENT],
            ['status', DBConstant::SHOW_COMMENT],
        ]);
    }
}
