<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarrantyClaimInfo extends Model
{
    use HasFactory;

    protected $table = 'WarrantyClaimInfo';

    protected $primaryKey = 'Id';

    public $timestamps = false;

    protected $guarded = [];

    public function parts()
    {
        return $this->hasMany(PartsDetail::class, 'WarrantyclaiminfoId', 'Id');
    }
    public function engineer()
    {
        return $this->belongsTo(User::class, 'EngineerId', 'Id');
    }
    public function spo()
    {
        return $this->belongsTo(User::class, 'SPOId', 'Id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductId', 'Id');
    }
    public function serviceDetail()
    {
        return $this->hasMany(ServiceHistoryDetail::class, 'WarrantyClaimInfoId', 'Id');
    }
    
    public function documents()
    {
        return $this->hasMany(Document::class, 'WarrantyClaimInfoId', 'Id');
    }
}
