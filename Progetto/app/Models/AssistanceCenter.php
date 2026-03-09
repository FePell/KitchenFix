<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssistanceCenter extends Model
{
    protected $fillable = [
        'name',
        'address',
    ];

    public function assistanceTechnicians()
    {
        return $this->hasMany(AssistanceTechnician::class);
    }
}