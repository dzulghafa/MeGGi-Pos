<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Suplier extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'FK_SUP';
    public $incrementing = false;

    protected $fillable = [
        'FK_SUP',
        'FNA_SUP',
        'FNOTELP',
        'FALAMAT',
        'FCONTACT'
    ];
}
