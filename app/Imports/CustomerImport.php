<?php

namespace App\Imports;

use App\Customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CustomerImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Customer([
            'name' => $row['name'],
            'cin' => $row['cin'],
            'address' => $row['address'],
            'birthday' => $row['birthday'],
            'phone' => $row['phone'],
            'image_path' => $row['image_path'],
            'parents_name' => $row['parents_name'],
            'customertype_id' => $row['customertype_id'],
            'companie_id' => $row['companie_id'],
            'municipalite_id' => $row['municipalite_id'],
        ]);
    }
}
