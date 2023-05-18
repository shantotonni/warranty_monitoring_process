<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartsDetail extends Model
{
    use HasFactory;

    protected $table = 'PartsDetail';

    protected $primaryKey = 'Id';

    public $timestamps = false;

    public function warranty_claim()
    {
        return $this->belongsTo(WarrantyClaimInfo::class, 'WarrantyclaiminfoId', 'Id');
    }
}
