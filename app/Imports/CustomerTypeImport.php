<?php

namespace App\Imports;

use App\CustomerType;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CustomerTypeImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new CustomerType([
            'name_fr' => $row['name_fr'],
            'name_ar' => $row['name_ar'],
        ]);
    }
}
