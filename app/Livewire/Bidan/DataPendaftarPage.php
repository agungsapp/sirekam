<?php

namespace App\Livewire\Bidan;

use App\Models\Pendaftaran;
use Livewire\Component;

class DataPendaftarPage extends Component
{

    public $pendaftars;
    public $title = 'Data Pendaftar';


    public function mount()
    {
        $this->pendaftars = Pendaftaran::where('status', '!=', 'selesai')->with('pasien')->orderBy('id', 'desc')->get();
    }


    public function render()
    {
        return view('livewire.bidan.data-pendaftar-page');
    }
}
