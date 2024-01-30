<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Sickness;

use Maatwebsite\Excel\Concerns\ToModel;

class DiseaseImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Sickness([
            'name' => $row[0],
            'type' => $row[1],
        ]); 
        
    }
}
