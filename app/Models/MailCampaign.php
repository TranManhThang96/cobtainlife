<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class MailCampaign extends Model
{
    use HasFactory;

    protected $table = 'campaigns';

    protected $fillable = [
        'subject',
        'to',
        'body',
        'created_by',
        'updated_by',
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

    public function setBodyAttribute($value)
    {
        $this->attributes['body'] = htmlspecialchars($value);
    }

    public function getBodyAttribute($value): string
    {
        return htmlspecialchars_decode($value);
    }
}
