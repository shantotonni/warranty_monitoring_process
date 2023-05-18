<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceHistoryDetail extends Model
{
    use HasFactory;

    protected $table = 'ServiceHistoryDetail';

    protected $primaryKey = 'Id';

    public $timestamps = false;
}
