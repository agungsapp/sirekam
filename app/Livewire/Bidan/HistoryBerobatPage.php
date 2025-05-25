<?php

namespace App\Livewire\Bidan;

use App\Models\Pendaftaran;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\PDF; // Impor facade yang benar
use Carbon\Carbon;

class HistoryBerobatPage extends Component
{
    public $pendaftars;
    public $tanggal_awal;
    public $tanggal_akhir;

    public function mount()
    {
        $this->pendaftars = Pendaftaran::where('status', 'selesai')
            ->with('pasien')
            ->orderBy('id', 'desc')
            ->get();
    }

    protected $rules = [
        'tanggal_awal' => ['nullable', 'date', 'before_or_equal:tanggal_akhir'],
        'tanggal_akhir' => ['nullable', 'date', 'after_or_equal:tanggal_awal'],
    ];

    protected $messages = [
        'tanggal_awal.date' => 'Tanggal awal harus valid.',
        'tanggal_awal.before_or_equal' => 'Tanggal awal harus sebelum atau sama dengan tanggal akhir.',
        'tanggal_akhir.date' => 'Tanggal akhir harus valid.',
        'tanggal_akhir.after_or_equal' => 'Tanggal akhir harus setelah atau sama dengan tanggal awal.',
    ];

    public function filterData()
    {
        $this->validate();

        $query = Pendaftaran::where('status', 'selesai')->with('pasien');

        if ($this->tanggal_awal) {
            $query->whereDate('tanggal_kunjungan', '>=', $this->tanggal_awal);
        }

        if ($this->tanggal_akhir) {
            $query->whereDate('tanggal_kunjungan', '<=', $this->tanggal_akhir);
        }

        $this->pendaftars = $query->orderBy('id', 'desc')->get();
        session()->flash('success', 'Data berhasil difilter.');
    }

    public function cetakPDF()
    {
        $this->validate();

        $query = Pendaftaran::where('status', 'selesai')->with('pasien');

        if ($this->tanggal_awal) {
            $query->whereDate('tanggal_kunjungan', '>=', $this->tanggal_awal);
        }

        if ($this->tanggal_akhir) {
            $query->whereDate('tanggal_kunjungan', '<=', $this->tanggal_akhir);
        }

        $pendaftars = $query->orderBy('id', 'desc')->get();

        if ($pendaftars->isEmpty()) {
            session()->flash('error', 'Tidak ada data untuk dicetak.');
            return;
        }

        $pdf = PDF::loadView('livewire.bidan.history-berobat-pdf', [
            'pendaftars' => $pendaftars,
            'tanggal_awal' => $this->tanggal_awal ? Carbon::parse($this->tanggal_awal)->format('d-m-Y') : 'Awal',
            'tanggal_akhir' => $this->tanggal_akhir ? Carbon::parse($this->tanggal_akhir)->format('d-m-Y') : 'Akhir',
        ]);

        $filename = 'laporan_history_berobat_' . Carbon::now()->format('Ymd_His') . '.pdf';
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, $filename);
    }

    public function render()
    {
        return view('livewire.bidan.history-berobat-page');
    }
}
