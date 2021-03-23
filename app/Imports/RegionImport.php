<?php

namespace App\Imports;

use App\Region;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RegionImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Region([
            'name_fr' => $row['name_fr'],
            'name_ar' => $row['name_ar'],
        ]);
    }
}
