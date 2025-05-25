<?php

namespace App\Livewire\Bidan;

use App\Models\Pasien;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class DetailPasienPage extends Component
{
    public $pasienId;
    public $pasien;

    public function mount($id)
    {
        try {
            $this->pasienId = $id;
            $this->pasien = Pasien::select('id', 'nik', 'nama', 'jenis_kelamin', 'tanggal_lahir', 'no_hp', 'alamat', 'created_at')
                ->with(['pendaftaran' => function ($q) {
                    $q->select('id', 'id_pasien', 'tanggal_kunjungan', 'status')
                        ->with([
                            'awal' => fn($q) => $q->select('id', 'id_pendaftaran', 'tanggal_periksa', 'tekanan_darah', 'berat_badan', 'tinggi_badan', 'keluhan'),
                            'lanjut' => fn($q) => $q->select('id', 'id_pendaftaran', 'diagnosa', 'tindakan', 'id_ruang_bersalin')
                                ->with(['resep' => fn($q) => $q->select('id', 'id_lanjut', 'id_obat', 'aturan')->with(['obat' => fn($q) => $q->select('id', 'nama')])])
                        ])
                        ->latest()
                        ->take(3); // Batasi 3 pendaftaran
                }])
                ->findOrFail($this->pasienId);
        } catch (\Exception $e) {
            Log::error('Gagal memuat detail pasien: ' . $e->getMessage(), [
                'pasien_id' => $this->pasienId,
                'exception' => $e,
            ]);
            session()->flash('error-message', 'Gagal memuat data pasien. Silakan coba lagi.');
            return redirect()->route('bidan.dashboard');
        }
    }

    public function render()
    {
        return view('livewire.bidan.detail-pasien-page');
    }
}
