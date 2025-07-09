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
        $this->pendaftars = Pendaftaran::whereIn('status', ['batal', 'selesai'])->with('pasien')->orderBy('id', 'desc')->get();

        // dd($this->pendaftars);
    }


    public function datang($id)
    {
        $pendaftaran = Pendaftaran::find($id);
        if ($pendaftaran) {
            $pendaftaran->status = 'menunggu';
            $pendaftaran->no_antrian = $pendaftaran->generateNoAntrian();
            $pendaftaran->save();
            $this->mount();
            session()->flash('success', 'Pendaftaran berhasil diperbarui.');
        } else {
            session()->flash('error', 'Pendaftaran tidak ditemukan.');
        }
    }

    public function tidakDatang($id)
    {
        $pendaftaran = Pendaftaran::find($id);
        if ($pendaftaran) {
            $pendaftaran->status = 'batal';
            $pendaftaran->save();
            $this->mount();
            session()->flash('success', 'Pendaftaran berhasil diperbarui.');
        } else {
            session()->flash('error', 'Pendaftaran tidak ditemukan.');
        }
    }


    public function render()
    {
        return view('livewire.bidan.data-pendaftar-page');
    }
}
