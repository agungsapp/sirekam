<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RuangBersalin extends Model
{
    //
    protected $table = 'ruang_bersalin';

    protected $fillable = [
        'nama',
        'keterangan'
    ];
}
