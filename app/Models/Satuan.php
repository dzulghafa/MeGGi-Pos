<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Satuan extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $primaryKey = 'FK_SAT';
    public $incrementing = false;

    protected $fillable = [
        'FK_SAT',
        'FN_SAT',
    ];
}
