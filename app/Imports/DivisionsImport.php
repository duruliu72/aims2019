<?php

namespace App\Imports;

use App\com\adventure\school\basic\Division;
use Maatwebsite\Excel\Concerns\ToModel;

class DivisionsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Division([
            'id'     => $row[0],
            'name'    => $row[1], 
        ]);
    }
}
