<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $table = 'province';

    protected $fillable = [
        'name',
        'code'
    ];

    public function districts()
    {
        return $this->hasMany(\App\Models\District::class, 'province_id', 'id');
    }
}
