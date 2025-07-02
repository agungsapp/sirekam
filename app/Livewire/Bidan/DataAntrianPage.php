<?php

namespace App\Livewire\Bidan;

use App\Models\Pendaftaran;
use Livewire\Component;

class DataAntrianPage extends Component
{

    public $pendaftars;
    public $title = 'Data Pendaftar';


    public function mount()
    {
        $this->pendaftars = Pendaftaran::whereNotIn('status', ['selesai', 'pending', 'batal'])
            ->with('pasien')
            ->orderBy('no_antrian', 'asc')
            ->get();
    }


    public function render()
    {
        return view('livewire.bidan.data-antrian-page');
    }
}
