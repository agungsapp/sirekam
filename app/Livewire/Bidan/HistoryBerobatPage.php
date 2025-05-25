<?php

namespace App\Livewire\Bidan;

use App\Models\Pendaftaran;
use Livewire\Component;

class HistoryBerobatPage extends Component
{

    public $pendaftars;


    public function mount()
    {
        $this->pendaftars = Pendaftaran::where('status', 'selesai')->with('pasien')->orderBy('id', 'desc')->get();
    }


    public function render()
    {
        return view('livewire.bidan.history-berobat-page');
    }
}
