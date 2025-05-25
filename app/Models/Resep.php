<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Resep extends Model
{
    protected $table = 'resep';

    protected $fillable = [
        'id_lanjut',
        'id_obat',
        'aturan'
    ];

    public function lanjut(): BelongsTo
    {
        return $this->belongsTo(PemeriksaanLanjut::class, 'id_lanjut');
    }

    public function obat(): BelongsTo
    {
        return $this->belongsTo(Obat::class, 'id_obat');
    }
}
