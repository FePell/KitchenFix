<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Malfunction extends Model
{
    protected $fillable = [
        'product_id',
        'description',
        'solution',
    ];

    public function product() //Un malfunzionamento appartiene ad 1 solo prodotto
    {
        return $this->belongsTo(Product::class);
    }
}