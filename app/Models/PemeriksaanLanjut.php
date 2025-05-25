<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PemeriksaanLanjut extends Model
{
    protected $table = 'pemeriksaan_lanjut';
    protected $fillable = [
        'id_pendaftaran',
        'diagnosa',
        'tindakan',
        'id_ruang_bersalin',
        'id_user',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function ruang(): BelongsTo
    {
        return $this->belongsTo(RuangBersalin::class, 'id_ruang_bersalin');
    }


    public function pendaftaran(): BelongsTo
    {
        return $this->belongsTo(Pendaftaran::class, 'id_pendaftaran');
    }

    public function resep(): HasMany
    {
        return $this->hasMany(Resep::class, 'id_lanjut');
    }
}
