<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssistanceTechnician extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'birth_date',
        'specialization',
        'assistance_center_id',
    ];

    public function user() //Un tecnico di assistenza appartiene ad 1 account utente
    {
        return $this->belongsTo(User::class);
    }

    public function assistanceCenter() //Un assistente tecnico appartiene ad 1 solo centro
    {
        return $this->belongsTo(AssistanceCenter::class,'assistance_center_id');
    }
}
