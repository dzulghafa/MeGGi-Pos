<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RelasiBarangSupplier extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'FKD_RLS';
    public $incrementing = false;

    protected $fillable = [
        'FKD_RLS',
        'FK_SUP',
        'FK_BRG',
        'FN_BRG_SUP',
        'FHARGA_AKHIR',
        
    ];
}
