<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $table = 'district';

    protected $fillable = [
        'name',
        'prefix',
        'province_id'
    ];

    public function wards()
    {
        return $this->hasMany(\App\Models\Ward::class, 'district_id', 'id');
    }
}
