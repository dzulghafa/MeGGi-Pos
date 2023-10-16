<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jenis extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'FK_JENIS';
    public $incrementing = false;

    protected $fillable = [
        'FK_JENIS',
        'FN_JENIS',
    ];
}
