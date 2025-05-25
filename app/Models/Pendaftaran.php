<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';
    protected $fillable = [
        'id_pasien',
        'tanggal_kunjungan',
        'status',
    ];

    public function pasien(): BelongsTo
    {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }

    public function awal(): HasOne
    {
        return $this->hasOne(PemeriksaanAwal::class, 'id_pendaftaran');
    }

    public function lanjut(): HasOne
    {
        return $this->hasOne(PemeriksaanLanjut::class, 'id_pendaftaran');
    }
}
