<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient_Medication extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'medication_id',
        'sickness_id',
        'dosage_amount',
        'dosage_frequency',
        'prescription_date',
        'start_date',
        'end_date',
    ];

    public function patients()
    {
        return $this->belongsToMany(Patient::class);
    }
            
}
