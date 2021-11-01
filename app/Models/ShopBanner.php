<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class ShopBanner extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'shop_banners';

    protected $fillable = [
        'image',
        'status',
        'sort',
        'html',
        'created_by',
        'updated_by'
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $user = Auth::guard('admin')->user();
            $model->created_by = $user->id;
            $model->updated_by = $user->id;
        });
        static::updating(function ($model) {
            $user = Auth::guard('admin')->user();
            $model->updated_by = $user->id;
        });
    }
}
