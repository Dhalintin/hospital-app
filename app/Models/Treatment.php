<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;

    protected $fillable = [
        'sickness_id',
        'doctor_id',
        'patient_id',
        'start_date',
        'end_date',
    ];

    public function sicknesses()
    {
        return $this->hasMany(Sickness::class, 'id', 'sickness_id');
    }

    public function patients()
    {
        return $this->belongsToMany(Patient::class);
    }
}
