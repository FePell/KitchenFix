<?php

namespace App\Models;

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

    public function staffTechnicians() //Un prodotto può essere gestito da 0..N tecnici staff
    {
        return $this->belongsToMany(StaffTechnician::class,'product_staff_technician');
    }

    public function malfunctions() //Un prodotto può avere da 0..N malfunzionamenti
    {
        return $this->hasMany(Malfunction::class);
    }
}