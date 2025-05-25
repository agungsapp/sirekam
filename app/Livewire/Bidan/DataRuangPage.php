<?php

namespace App\Livewire\Bidan;

use App\Models\RuangBersalin;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class DataRuangPage extends Component
{
    public $ruangans;
    public $nama, $keterangan;
    public $selectedRuangId = null;

    public function mount()
    {
        $this->loadRuangans();
    }

    protected $messages = [
        'nama.required' => 'Nama ruangan wajib diisi.',
        'nama.string' => 'Nama ruangan harus berupa teks.',
        'nama.max' => 'Nama ruangan maksimal 100 karakter.',
        'nama.unique' => 'Nama ruangan sudah terdaftar.',
        'keterangan.max' => 'Keterangan maksimal 1000 karakter.',
    ];

    protected function rules()
    {
        return [
            'nama' => [
                'required',
                'string',
                'max:100',
                $this->selectedRuangId
                    ? 'unique:ruang_bersalin,nama,' . $this->selectedRuangId
                    : 'unique:ruang_bersalin,nama'
            ],
            'keterangan' => 'nullable|string|max:1000',
        ];
    }

    public function loadRuangans()
    {
        $this->ruangans = RuangBersalin::all();
    }

    public function simpan()
    {
        $validatedData = $this->validate();

        try {
            DB::beginTransaction();

            if ($this->selectedRuangId) {
                // Update
                RuangBersalin::where('id', $this->selectedRuangId)->update([
                    'nama' => $this->nama,
                    'keterangan' => $this->keterangan,
                ]);
                session()->flash('success', 'Ruangan berhasil diperbarui.');
            } else {
                // Create
                RuangBersalin::create([
                    'nama' => $this->nama,
                    'keterangan' => $this->keterangan,
                ]);
                session()->flash('success', 'Ruangan berhasil ditambahkan.');
            }

            DB::commit();
            $this->resetForm();
            $this->loadRuangans();
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $ruang = RuangBersalin::findOrFail($id);
        $this->selectedRuangId = $id;
        $this->nama = $ruang->nama;
        $this->keterangan = $ruang->keterangan;
    }

    public function delete($id)
    {
        try {
            RuangBersalin::where('id', $id)->delete();
            session()->flash('success', 'Ruangan berhasil dihapus.');
            $this->loadRuangans();
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menghapus ruangan: ' . $e->getMessage());
        }
    }

    public function resetForm()
    {
        $this->reset(['nama', 'keterangan', 'selectedRuangId']);
    }

    public function render()
    {
        return view('livewire.bidan.data-ruang-page');
    }
}
