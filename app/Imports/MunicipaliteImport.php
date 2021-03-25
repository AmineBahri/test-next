<?php

namespace App\Imports;

use App\Municipalite;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MunicipaliteImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Municipalite([
            'name_fr' => $row['name_fr'],
            'name_ar' => $row['name_ar'],
            'region_id' => $row['region_id'],
        ]);
    }
}
