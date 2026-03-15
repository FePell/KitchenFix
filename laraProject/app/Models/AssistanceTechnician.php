<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assistanceCenter()
    {
        return $this->belongsTo(
            AssistanceCenter::class,
            'assistance_center_id'
        );
    }
}
