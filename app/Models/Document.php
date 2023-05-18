<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $table = 'Documents';

    protected $primaryKey = 'Id';

    public $timestamps = false;

    public $fillable = [
        'WarrantyClaimInfoId', 'Name', 'CreatedAt', 'UpdatedAt'
    ];
}
