<?php

namespace App\Livewire\Bidan;

use App\Models\Pasien;
use Livewire\Component;

class DataPasienPage extends Component
{


    public $pasiens;


    public function mount()
    {
        $this->pasiens = Pasien::with('pendaftaran')->orderBy('id', 'desc')->get();
    }


    public function render()
    {
        return view('livewire.bidan.data-pasien-page');
    }
}
