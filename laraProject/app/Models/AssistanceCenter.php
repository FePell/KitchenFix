<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssistanceCenter extends Model
{
    protected $fillable = [
        'name',
        'address',
    ];

    public function assistanceTechnicians() //Un centro può avere da 0..N tecnici di assistenza
    {
        return $this->hasMany(AssistanceTechnician::class);
    }
}