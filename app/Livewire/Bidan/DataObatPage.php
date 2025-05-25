<?php

namespace App\Livewire\Bidan;

use App\Models\Obat;
use App\Models\RuangBersalin;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class DataObatPage extends Component
{
    public $obats;
    public $nama, $keterangan;
    public $selectedObatId = null;

    public function mount()
    {
        $this->loadObats();
    }

    protected $messages = [
        'nama.required' => 'Nama obat wajib diisi.',
        'nama.string' => 'Nama obat harus berupa teks.',
        'nama.max' => 'Nama obat maksimal 100 karakter.',
        'nama.unique' => 'Nama obat sudah terdaftar.',
        'keterangan.max' => 'Keterangan maksimal 1000 karakter.',
    ];

    protected function rules()
    {
        return [
            'nama' => [
                'required',
                'string',
                'max:100',
                $this->selectedObatId
                    ? 'unique:obat,nama,' . $this->selectedObatId
                    : 'unique:obat,nama'
            ],
            'keterangan' => 'nullable|string|max:1000',
        ];
    }

    public function loadObats()
    {
        $this->obats = Obat::orderBy('id', 'desc')->get();
    }

    public function simpan()
    {
        $validatedData = $this->validate();

        try {
            DB::beginTransaction();

            if ($this->selectedObatId) {
                // Update
                Obat::where('id', $this->selectedObatId)->update([
                    'nama' => $this->nama,
                    'keterangan' => $this->keterangan,
                ]);
                session()->flash('success', 'Obat berhasil diperbarui.');
            } else {
                // Create
                Obat::create([
                    'nama' => $this->nama,
                    'keterangan' => $this->keterangan,
                ]);
                session()->flash('success', 'Obat berhasil ditambahkan.');
            }

            DB::commit();
            $this->resetForm();
            $this->loadObats();
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $obat = Obat::findOrFail($id);
        $this->selectedObatId = $id;
        $this->nama = $obat->nama;
        $this->keterangan = $obat->keterangan;
    }

    public function delete($id)
    {
        try {
            Obat::where('id', $id)->delete();
            session()->flash('success', 'Obat berhasil dihapus.');
            $this->loadObats();
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menghapus obat: ' . $e->getMessage());
        }
    }

    public function resetForm()
    {
        $this->reset(['nama', 'keterangan', 'selectedObatId']);
    }

    public function render()
    {
        return view('livewire.bidan.data-obat-page');
    }
}
