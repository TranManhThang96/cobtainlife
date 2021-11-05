<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
class Tag extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'shop_tags';

    protected $fillable = [
        'label',
        'alias',
        'created_by',
        'updated_by'
    ];

    public static function boot()
    {
       parent::boot();
       static::creating(function($model)
       {
           $user = Auth::guard('admin')->user();
           $model->created_by = $user->id ?? null;
           $model->updated_by = $user->id ?? null;
       });
       static::updating(function($model)
       {
           $user = Auth::guard('admin')->user();
           $model->updated_by = $user->id ?? null;
       });
    }
}
