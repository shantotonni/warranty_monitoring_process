<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parts extends Model
{
    use HasFactory;

    protected $table = 'Parts';

    protected $primaryKey = 'Id';

    public $timestamps = false;

    public $fillable = [
        'PartsCode', 'PartsName', 'Price', 'CreatedAt', 'UpdatedAt'
    ];
}
