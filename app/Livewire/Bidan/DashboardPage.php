<?php

namespace App\Livewire\Bidan;

use App\Models\Obat;
use App\Models\Pendaftaran;
use App\Models\RuangBersalin;
use Livewire\Component;

class DashboardPage extends Component
{
    public $counting;
    public $terbaru;

    public function mount()
    {
        $this->loadCounting();
    }


    public function loadCounting()
    {

        $countObat = Obat::all()->count();
        $countRuang = RuangBersalin::all()->count();
        $pendaftar = Pendaftaran::query();
        $menunggu = $pendaftar->where('status', 'menunggu')->get()->count();
        $diperiksa = $pendaftar->where('status', 'diperiksa')->get()->count();

        $this->counting = [
            'dataObat' => $countObat,
            'dataRuang' => $countRuang,
            'menunggu' => $menunggu,
            'diperiksa' => $diperiksa,

        ];

        $this->terbaru =  $pendaftar->where('status', 'diperiksa')->get();


        // dd($this->counting);
    }

    public function render()
    {
        return view('livewire.bidan.dashboard-page');
    }
}
