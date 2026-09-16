<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone_number',
        'latitude',
        'longitude',
        'radius_meters',
    ];

    protected $casts = [
        'latitude'      => 'float',
        'longitude'     => 'float',
        'radius_meters' => 'integer',
    ];

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }
}