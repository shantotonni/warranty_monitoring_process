<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserArea extends Model
{
    use HasFactory;

    protected $table = 'UserArea';

    protected $primaryKey = 'Id';

    public $timestamps = false;

    public function engineer()
    {
        return $this->belongsTo(User::class, 'UserId', 'Id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'AreaId', 'Id');
    }
    
    public function region()
    {
        return $this->belongsTo(Region::class, 'RegionId', 'Id');
    }
}
