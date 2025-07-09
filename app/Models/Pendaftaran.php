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
        'no_antrian',
        'tanggal_kunjungan',
        'status',
    ];

    public function generateNoAntrian(): int
    {
        $lastPendaftaran = self::where('status', '!=', 'selesai')
            ->orderBy('no_antrian', 'desc')
            ->first();

        return $lastPendaftaran ? $lastPendaftaran->no_antrian + 1 : 1;
    }

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
