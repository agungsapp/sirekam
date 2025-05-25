<?php

namespace App\Livewire\Bidan;

use App\Models\Testimoni;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DataTestimoniPage extends Component
{
    use WithFileUploads;

    public $testimonis;
    public $nama, $pekerjaan, $testimoni, $image, $rating, $status;
    public $selectedTestimoniId = null;
    public $imagePreview = null;

    public function mount()
    {
        $this->loadTestimonis();
    }

    protected $messages = [
        'nama.required' => 'Nama wajib diisi.',
        'nama.string' => 'Nama harus berupa teks.',
        'nama.max' => 'Nama maksimal 100 karakter.',
        'pekerjaan.required' => 'Pekerjaan wajib diisi.',
        'pekerjaan.string' => 'Pekerjaan harus berupa teks.',
        'pekerjaan.max' => 'Pekerjaan maksimal 100 karakter.',
        'testimoni.required' => 'Testimoni wajib diisi.',
        'testimoni.string' => 'Testimoni harus berupa teks.',
        'image.required' => 'Gambar wajib diunggah.',
        'image.image' => 'File harus berupa gambar.',
        'image.max' => 'Ukuran gambar maksimal 2MB.',
        'rating.required' => 'Rating wajib diisi.',
        'rating.in' => 'Rating harus antara 1 dan 5.',
        'status.required' => 'Status wajib diisi.',
        'status.in' => 'Status harus active atau inactive.',
    ];

    protected function rules()
    {
        return [
            'nama' => 'required|string|max:100',
            'pekerjaan' => 'required|string|max:100',
            'testimoni' => 'required|string',
            'image' => [
                $this->selectedTestimoniId ? 'nullable' : 'required',
                'image',
                'max:2048', // 2MB
            ],
            'rating' => 'required|in:1,2,3,4,5',
            'status' => 'required|in:active,inactive',
        ];
    }

    public function loadTestimonis()
    {
        $this->testimonis = Testimoni::all();
    }

    public function simpan()
    {
        $validatedData = $this->validate();

        try {
            DB::beginTransaction();

            if ($this->selectedTestimoniId) {
                // Update
                $testimoni = Testimoni::findOrFail($this->selectedTestimoniId);
                $data = [
                    'nama' => $this->nama,
                    'pekerjaan' => $this->pekerjaan,
                    'testimoni' => $this->testimoni,
                    'rating' => $this->rating,
                    'status' => $this->status,
                ];

                if ($this->image) {
                    // Hapus gambar lama
                    if ($testimoni->image) {
                        Storage::disk('public')->delete($testimoni->image);
                    }
                    // Simpan gambar baru
                    $data['image'] = $this->image->store('testimoni', 'public');
                }

                $testimoni->update($data);
                session()->flash('success', 'Testimoni berhasil diperbarui.');
            } else {
                // Create
                $data = [
                    'nama' => $this->nama,
                    'pekerjaan' => $this->pekerjaan,
                    'testimoni' => $this->testimoni,
                    'image' => $this->image->store('testimoni', 'public'),
                    'rating' => $this->rating,
                    'status' => $this->status,
                ];

                Testimoni::create($data);
                session()->flash('success', 'Testimoni berhasil ditambahkan.');
            }

            DB::commit();
            $this->resetForm();
            $this->loadTestimonis();
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $testimoni = Testimoni::findOrFail($id);
        $this->selectedTestimoniId = $id;
        $this->nama = $testimoni->nama;
        $this->pekerjaan = $testimoni->pekerjaan;
        $this->testimoni = $testimoni->testimoni;
        $this->rating = $testimoni->rating;
        $this->status = $testimoni->status;
        $this->imagePreview = $testimoni->image ? Storage::url($testimoni->image) : null;
    }

    public function delete($id)
    {
        try {
            $testimoni = Testimoni::findOrFail($id);
            if ($testimoni->image) {
                Storage::disk('public')->delete($testimoni->image);
            }
            $testimoni->delete();
            session()->flash('success', 'Testimoni berhasil dihapus.');
            $this->loadTestimonis();
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menghapus testimoni: ' . $e->getMessage());
        }
    }

    public function resetForm()
    {
        $this->reset(['nama', 'pekerjaan', 'testimoni', 'image', 'rating', 'status', 'selectedTestimoniId', 'imagePreview']);
    }

    public function render()
    {
        return view('livewire.bidan.data-testimoni-page');
    }
}
