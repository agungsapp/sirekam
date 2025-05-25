<?php

namespace App\Livewire\Bidan;

use App\Models\PemeriksaanAwal;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class PemeriksaanAwalPage extends Component
{
    public $title = 'Pemeriksaan Awal';
    public $pendaftar;
    public $idPendaftar;

    public $tanggalPeriksa, $tekananDarah, $beratBadan, $tinggiBadan, $keluhan;

    public function mount($id)
    {
        $this->idPendaftar = $id;
        $this->pendaftar = Pendaftaran::with('pasien')->findOrFail($id);
    }

    protected $messages = [
        'tanggalPeriksa.required' => 'Tanggal pemeriksaan wajib diisi.',
        'tanggalPeriksa.date' => 'Tanggal pemeriksaan harus berupa tanggal yang valid.',
        'tekananDarah.required' => 'Tekanan darah wajib diisi.',
        'tekananDarah.regex' => 'Format tekanan darah harus seperti 120/80.',
        'beratBadan.required' => 'Berat badan wajib diisi.',
        'beratBadan.numeric' => 'Berat badan harus berupa angka.',
        'beratBadan.min' => 'Berat badan minimal 1 kg.',
        'beratBadan.max' => 'Berat badan maksimal 300 kg.',
        'tinggiBadan.required' => 'Tinggi badan wajib diisi.',
        'tinggiBadan.numeric' => 'Tinggi badan harus berupa angka.',
        'tinggiBadan.min' => 'Tinggi badan minimal 1 cm.',
        'tinggiBadan.max' => 'Tinggi badan maksimal 250 cm.',
        'keluhan.required' => 'Keluhan wajib diisi.',
        'keluhan.min' => 'Keluhan minimal 3 karakter.',
        'keluhan.max' => 'Keluhan maksimal 1000 karakter.'
    ];

    protected function rules()
    {
        return [
            'tanggalPeriksa' => 'required|date',
            'tekananDarah' => ['required', 'regex:/^\d{2,3}\/\d{2,3}$/'],
            'beratBadan' => 'required|numeric|min:1|max:300',
            'tinggiBadan' => 'required|numeric|min:1|max:250',
            'keluhan' => 'required|string|min:3|max:1000',
        ];
    }

    public function simpan()
    {
        $validatedData = $this->validate();

        try {
            DB::beginTransaction();

            PemeriksaanAwal::create([
                'id_pendaftaran' => $this->idPendaftar,
                'tanggal_periksa' => $this->tanggalPeriksa,
                'tekanan_darah' => $this->tekananDarah,
                'berat_badan' => $this->beratBadan,
                'tinggi_badan' => $this->tinggiBadan,
                'keluhan' => $this->keluhan,
                'id_user' => Auth::id(),
            ]);

            $pendaftar = Pendaftaran::find($this->idPendaftar);
            $pendaftar->status = 'diperiksa';
            $pendaftar->update();

            DB::commit();
            session()->flash('success', 'Data pemeriksaan berhasil disimpan.');
            return redirect()->route('bidan.pendaftar');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.bidan.pemeriksaan-awal-page');
    }
}
