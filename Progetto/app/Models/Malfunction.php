<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Malfunction extends Model
{
    protected $fillable = [
        'product_id',
        'description',
        'solution',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}