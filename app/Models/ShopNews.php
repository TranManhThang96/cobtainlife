<?php

namespace App\Models;

use App\Enums\DBConstant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
class ShopNews extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'shop_news';

    protected $fillable = [
        'title',
        'alias',
        'image',
        'keyword',
        'description',
        'content',
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
           $model->created_by = $user->id ?? null;
           $model->updated_by = $user->id ?? null;
       });
       static::updating(function($model)
       {
           $user = Auth::guard('admin')->user();
           $model->updated_by = $user->id ?? null;
       });
    }

    public function tags()
    {
        return $this->belongsToMany(\App\Models\Tag::class, 'shop_news_tag', 'news_id' ,'tag_id');
    }

    public function comments()
    {
        return $this->hasMany(\App\Models\ShopComment::class, 'object_id', 'id')->where([
            ['type', DBConstant::NEWS_COMMENT],
            ['comment_parent', DBConstant::NO_COMMENT_PARENT],
            ['status', DBConstant::SHOW_COMMENT],
        ]);
    }
}
