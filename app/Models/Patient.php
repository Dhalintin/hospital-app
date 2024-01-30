<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'firstname',
        'lastname',
        'dob',
        'gender',
        'email',
        'phone'
    ];

    public function sicknesses()
    {
        return $this->belongsToMany(Sickness::class);
    }

    public function treatments()
    {
        return $this->hasMany(Treatment::class, 'patient_id', 'id');
    }

    public function pat_meds()
    {
        return $this->hasMany(PatientMedication::class, 'patient_id', 'id');
    }
}
