<?php

namespace App\Imports;

use App\Models\Parts;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PartsImport implements ToModel,WithStartRow
{
    public function startRow(): int
    {
        return 2;
    }
    
    public function model(array $row)
    {
        return new Parts([
                'PartsCode' => $row[0],
                'PartsName' => $row[1],
                'Price'     => $row[2],
                'CreatedAt' => Carbon::now()
        ]);
    }
}
