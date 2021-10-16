<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DateTimeInterface;
use Illuminate\Support\Facades\Auth;
class ShopCategory extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'shop_categories';

    protected $fillable = [
        'title',
        'alias',
        'image',
        'parent',
        'description',
        'top',
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

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y/m/d H:i:s');
    }

    public function products()
    {
        return $this->hasMany(\App\Models\ShopProduct::class, 'category_id', 'id');
    }

    public function categories()
    {
        return $this->hasMany(\App\Models\ShopCategory::class, 'parent', 'id');
    }

    public function parents()
    {
        return $this->belongsTo(\App\Models\ShopCategory::class, 'parent', 'id');
    }

}
