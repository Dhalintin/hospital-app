<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Medication;
use Maatwebsite\Excel\Concerns\ToModel;


class MedicationImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Medication([
            'medication_name' => $row[0],
            'theurepetic_class' => $row[1]
        ]); 
        
    }
}
