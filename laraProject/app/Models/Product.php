<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'usage_techniques',
        'installation',
        'image',
    ];

    public function staffTechnicians()
    {
        return $this->belongsToMany(
            StaffTechnician::class,
            'product_staff_technician'
        );
    }

    public function malfunctions()
    {
        return $this->hasMany(Malfunction::class);
    }
}