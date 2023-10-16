<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'FK_CUS';
    public $incrementing = false;

    protected $fillable = [
        'FK_CUS',
        'FNA_CUS',
        'FNOTELP',
        'FALAMAT',
        'FCONTACT',
    ];
}
