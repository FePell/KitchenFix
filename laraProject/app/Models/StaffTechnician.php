<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffTechnician extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
    ];

    public function user() //Un tecnico dello staff appartiene ad 1 account utente
    {
        return $this->belongsTo(User::class);
    }

    public function products() //Un tecnico dello staff può gestire da 1..N prodotti
    {
        return $this->belongsToMany(Product::class,'product_staff_technician');
    }
}