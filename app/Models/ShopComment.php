<?php

namespace App\Models;

use App\Enums\DBConstant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class ShopComment extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'shop_comments';

    protected $fillable = [
        'customer_id',
        'customer_name',
        'customer_email',
        'customer_website',
        'comment',
        'comment_parent',
        'type',
        'object_id',
        'rating',
        'status',
        'user_agent',
        'device_type',
        'ip_address',
        'created_by'
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $user = Auth::guard('admin')->user();
            $model->created_by = $user->id ?? null;
        });
    }

    public function child()
    {
        return $this->hasMany(\App\Models\ShopComment::class, 'comment_parent', 'id');
    }

    public function scopeNoParent($query)
    {
        return $query->where('comment_parent', DBConstant::NO_COMMENT_PARENT); //0: no comment parent
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function news()
    {
        return $this->belongsTo(\App\Models\ShopNews::class, 'object_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(\App\Models\ShopProduct::class, 'object_id', 'id');
    }
}
