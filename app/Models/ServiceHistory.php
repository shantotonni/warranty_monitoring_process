<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceHistory extends Model
{
    use HasFactory;

    protected $table = 'ServiceHistory';

    protected $primaryKey = 'Id';

    public $timestamps = false;

    public function serviceDetail(){
        return $this->hasOne(ServiceHistoryDetail::class,'ServiceHistoryId','Id');
    }
}
