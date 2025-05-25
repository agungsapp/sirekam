<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PemeriksaanAwal extends Model
{
    protected $table = 'pemeriksaan_awal';

    protected $fillable = [
        'id_pendaftaran',
        'tanggal_periksa',
        'tekanan_darah',
        'berat_badan',
        'tinggi_badan',
        'keluhan',
        'id_user'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function pendaftaran(): BelongsTo
    {
        return $this->belongsTo(Pendaftaran::class, 'id_pendaftaran');
    }
}
