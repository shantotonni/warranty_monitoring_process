<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $table = 'Area';

    protected $primaryKey = 'Id';

    public $timestamps = false;

    public function region()
    {
        return $this->belongsTo(Region::class, 'RegionId', 'Id');
    }
}
