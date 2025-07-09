<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Pasien extends Authenticatable
{
    public $table = 'pasien';

    public $fillable = [
        'nik',
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'no_hp',
        'alamat',
        'password'
    ];

    // Accessor untuk mendapatkan umur
    public function getUmurAttribute()
    {
        return Carbon::parse($this->tanggal_lahir)->age;
    }

    public function pendaftaran(): HasMany
    {
        return $this->hasMany(Pendaftaran::class, 'id_pasien');
    }

    public static function generatePassword($tanggalLahir): string
    {
        // Menggunakan format tanggal lahir untuk generate password
        $password = Carbon::parse($tanggalLahir)->format('dmY');
        return bcrypt($password); // Mengembalikan password yang terenkripsi
    }
}
