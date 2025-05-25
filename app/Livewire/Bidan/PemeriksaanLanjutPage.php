<?php

namespace App\Livewire\Bidan;

use App\Models\PemeriksaanAwal;
use App\Models\PemeriksaanLanjut;
use App\Models\Pendaftaran;
use App\Models\RuangBersalin;
use App\Models\Obat;
use App\Models\Resep;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PemeriksaanLanjutPage extends Component
{
    public $title = 'Pemeriksaan Lanjutan';
    public $pendaftar;
    public $idPendaftar;
    public $ruangans;
    public $obats;
    public $diagnosa, $tindakan, $selectedRuang, $perluRuang = false;
    public $pemeriksaanAwal;
    public $idPemeriksaanAwal;
    public $selectedObat, $aturan;
    public $tempReseps = [];

    public function mount($id)
    {
        $this->idPendaftar = $id;
        $this->pendaftar = Pendaftaran::with('pasien')->findOrFail($id);
        $this->ruangans = RuangBersalin::all();
        $this->obats = Obat::all();
        $this->pemeriksaanAwal = PemeriksaanAwal::where('id_pendaftaran', $id)->first();
        $this->idPemeriksaanAwal = $this->pemeriksaanAwal?->id;

        // Flash pesan jika ruangans kosong
        if ($this->ruangans->isEmpty()) {
            session()->flash('warning', 'Tidak ada ruang bersalin tersedia. Silakan tambahkan ruang bersalin terlebih dahulu.');
        }
    }

    // public function updatedPerluRuang($value)
    // {
    //     dd($value);
    // }

    // public function updated($property)
    // {
    //     // $property: The name of the current property that was updated

    //     if ($property === 'perluRuang') {
    //         dd("masuk");
    //     }
    // }

    protected $messages = [
        'diagnosa.required' => 'Diagnosa wajib diisi.',
        'diagnosa.string' => 'Diagnosa harus berupa teks.',
        'diagnosa.max' => 'Diagnosa maksimal 1000 karakter.',
        'tindakan.required' => 'Tindakan wajib diisi.',
        'tindakan.string' => 'Tindakan harus berupa teks.',
        'tindakan.max' => 'Tindakan maksimal 1000 karakter.',
        'selectedRuang.required_if' => 'Pilih ruangan jika memerlukan ruang bersalin.',
        'selectedRuang.exists' => 'Ruangan yang dipilih tidak valid.',
        'selectedObat.required' => 'Pilih obat sebelum menambahkannya.',
        'selectedObat.exists' => 'Obat yang dipilih tidak valid.',
        'aturan.required' => 'Aturan penggunaan obat wajib diisi.',
        'aturan.string' => 'Aturan harus berupa teks.',
        'aturan.max' => 'Aturan maksimal 255 karakter.',
    ];

    protected function rules()
    {
        $rules = [
            'diagnosa' => ['required', 'string', 'max:1000'],
            'tindakan' => ['required', 'string', 'max:1000'],
            'selectedRuang' => ['nullable'],
        ];

        if ($this->perluRuang) {
            $rules['selectedRuang'][] = 'required';
            $rules['selectedRuang'][] = 'exists:ruang_bersalin,id';
        }

        return $rules;
    }

    public function tambahResep()
    {
        $this->validate([
            'selectedObat' => 'required|exists:obat,id',
            'aturan' => 'required|string|max:255',
        ], $this->messages);

        $obat = Obat::find($this->selectedObat);
        if (in_array($this->selectedObat, array_column($this->tempReseps, 'id_obat'))) {
            session()->flash('error', 'Obat ' . $obat->nama . ' sudah ada di daftar resep.');
            return;
        }

        $this->tempReseps[] = [
            'id_obat' => $obat->id,
            'nama_obat' => $obat->nama,
            'keterangan' => $obat->keterangan,
            'aturan' => $this->aturan,
        ];

        $this->reset(['selectedObat', 'aturan']);
        session()->flash('success_temp', 'Obat berhasil ditambahkan ke daftar sementara.');
    }

    public function hapusResep($index)
    {
        if (isset($this->tempReseps[$index])) {
            unset($this->tempReseps[$index]);
            $this->tempReseps = array_values($this->tempReseps); // Reindex array
            session()->flash('success_temp', 'Obat berhasil dihapus dari daftar sementara.');
        }
    }

    public function simpan()
    {
        if (!$this->idPemeriksaanAwal) {
            session()->flash('error', 'Data pemeriksaan awal tidak ditemukan. Silakan lakukan pemeriksaan awal terlebih dahulu.');
            return;
        }
        // dd($this->selectedRuang);
        $this->validate();

        try {
            DB::beginTransaction();

            $pemeriksaanLanjut = PemeriksaanLanjut::create([
                'id_pendaftaran' => $this->idPendaftar,
                'diagnosa' => $this->diagnosa,
                'tindakan' => $this->tindakan,
                'id_ruang_bersalin' => $this->perluRuang ? $this->selectedRuang : null,
                'id_user' => Auth::id(),
            ]);

            foreach ($this->tempReseps as $resep) {
                Resep::create([
                    'id_lanjut' => $pemeriksaanLanjut->id,
                    'id_obat' => $resep['id_obat'],
                    'aturan' => $resep['aturan'],
                ]);
            }

            $pendaftar = Pendaftaran::find($this->idPendaftar);
            $pendaftar->status = 'selesai';
            $pendaftar->save();

            DB::commit();
            session()->flash('success', 'Data pemeriksaan lanjutan dan resep obat berhasil disimpan.');
            return redirect()->route('bidan.pendaftar');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.bidan.pemeriksaan-lanjut-page');
    }
}
