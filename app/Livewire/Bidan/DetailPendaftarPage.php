<?php

namespace App\Livewire\Bidan;

use App\Models\Pendaftaran;
use Livewire\Component;

class DetailPendaftarPage extends Component
{
    public $pendaftarId;
    public $pendaftar;

    public function mount($id)
    {
        $this->pendaftarId = $id;
        $this->pendaftar = Pendaftaran::with(['pasien', 'awal', 'lanjut'])->find($this->pendaftarId);
    }

    public function render()
    {
        return view('livewire.bidan.detail-pendaftar-page');
    }
}
