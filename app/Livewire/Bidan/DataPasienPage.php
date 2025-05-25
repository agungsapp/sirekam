<?php

namespace App\Livewire\Bidan;

use App\Models\Pasien;
use App\Models\Pendaftaran;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DataPasienPage extends Component
{
    public $pasiens;
    public $nik;
    public $nama;
    public $jenis_kelamin;
    public $tanggal_lahir;
    public $no_hp;
    public $alamat;
    public $editMode = false;
    public $pasienId;

    public function mount()
    {
        $this->pasiens = Pasien::with('pendaftaran')->orderBy('id', 'desc')->get();
    }

    protected function rules()
    {
        $rules = [
            'nik' => ['required', 'string', 'size:16'],
            'nama' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', 'in:l,p'],
            'tanggal_lahir' => ['required', 'date', 'before:today'],
            'no_hp' => ['required', 'string', 'max:15', 'regex:/^(\+62|0)[0-9]{9,12}$/'],
            'alamat' => ['required', 'string', 'max:500'],
        ];

        // Tambahkan aturan unik untuk NIK, kecuali saat edit pasien yang sama
        if (!$this->editMode) {
            $rules['nik'][] = 'unique:pasien,nik';
        } else {
            $rules['nik'][] = 'unique:pasien,nik,' . $this->pasienId;
        }

        return $rules;
    }

    protected $messages = [
        'nik.required' => 'NIK wajib diisi.',
        'nik.size' => 'NIK harus 16 digit.',
        'nik.unique' => 'NIK sudah terdaftar.',
        'nama.required' => 'Nama wajib diisi.',
        'nama.max' => 'Nama maksimal 255 karakter.',
        'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
        'jenis_kelamin.in' => 'Jenis kelamin harus laki-laki atau perempuan.',
        'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
        'tanggal_lahir.date' => 'Tanggal lahir harus valid.',
        'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini.',
        'no_hp.required' => 'No. HP wajib diisi.',
        'no_hp.regex' => 'No. HP harus format Indonesia (+62 atau 0 diikuti 9-12 digit).',
        'no_hp.max' => 'No. HP maksimal 15 karakter.',
        'alamat.required' => 'Alamat wajib diisi.',
        'alamat.max' => 'Alamat maksimal 500 karakter.',
    ];

    public function simpanPasien()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            // Simpan pasien
            $pasien = Pasien::create([
                'nik' => $this->nik,
                'nama' => $this->nama,
                'jenis_kelamin' => $this->jenis_kelamin,
                'tanggal_lahir' => $this->tanggal_lahir,
                'no_hp' => $this->no_hp,
                'alamat' => $this->alamat,
            ]);

            // Buat pendaftaran dengan status menunggu
            Pendaftaran::create([
                'id_pasien' => $pasien->id,
                'tanggal_kunjungan' => Carbon::today(),
                'status' => 'menunggu',
            ]);

            DB::commit();

            // Reset form
            $this->resetForm();

            // Muat ulang data pasien
            $this->pasiens = Pasien::with('pendaftaran')->orderBy('id', 'desc')->get();

            session()->flash('success', 'Pasien berhasil ditambahkan dan terdaftar dengan status menunggu!');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Gagal menambahkan pasien: ' . $e->getMessage());
        }
    }

    public function editPasien($id)
    {
        $pasien = Pasien::findOrFail($id);
        $this->pasienId = $id;
        $this->nik = $pasien->nik;
        $this->nama = $pasien->nama;
        $this->jenis_kelamin = $pasien->jenis_kelamin;
        $this->tanggal_lahir = $pasien->tanggal_lahir;
        $this->no_hp = $pasien->no_hp;
        $this->alamat = $pasien->alamat;
        $this->editMode = true;
    }

    public function updatePasien()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $pasien = Pasien::findOrFail($this->pasienId);
            $pasien->update([
                'nik' => $this->nik,
                'nama' => $this->nama,
                'jenis_kelamin' => $this->jenis_kelamin,
                'tanggal_lahir' => $this->tanggal_lahir,
                'no_hp' => $this->no_hp,
                'alamat' => $this->alamat,
            ]);

            DB::commit();

            // Reset form
            $this->resetForm();

            // Muat ulang data pasien
            $this->pasiens = Pasien::with('pendaftaran')->orderBy('id', 'desc')->get();

            session()->flash('success', 'Pasien berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Gagal memperbarui pasien: ' . $e->getMessage());
        }
    }

    public function batalEdit()
    {
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset(['nik', 'nama', 'jenis_kelamin', 'tanggal_lahir', 'no_hp', 'alamat', 'editMode', 'pasienId']);
    }

    public function render()
    {
        return view('livewire.bidan.data-pasien-page');
    }
}
