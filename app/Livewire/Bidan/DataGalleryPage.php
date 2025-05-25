<?php

namespace App\Livewire\Bidan;

use App\Models\Gallery;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DataGalleryPage extends Component
{
    use WithFileUploads;

    public $galleries;
    public $image, $keterangan;
    public $selectedGalleryId = null;
    public $imagePreview = null;

    public function mount()
    {
        $this->loadGalleries();
    }

    protected $messages = [
        'image.required' => 'Gambar wajib diunggah.',
        'image.image' => 'File harus berupa gambar.',
        'image.max' => 'Ukuran gambar maksimal 2MB.',
        'keterangan.required' => 'Keterangan wajib diisi.',
        'keterangan.string' => 'Keterangan harus berupa teks.',
        'keterangan.max' => 'Keterangan maksimal 1000 karakter.',
    ];

    protected function rules()
    {
        return [
            'image' => [
                $this->selectedGalleryId ? 'nullable' : 'required',
                'image',
                'max:2048', // 2MB
            ],
            'keterangan' => 'required|string|max:1000',
        ];
    }

    public function loadGalleries()
    {
        $this->galleries = Gallery::all();
    }

    public function simpan()
    {
        $validatedData = $this->validate();

        try {
            DB::beginTransaction();

            if ($this->selectedGalleryId) {
                // Update
                $gallery = Gallery::findOrFail($this->selectedGalleryId);
                $data = [
                    'keterangan' => $this->keterangan,
                ];

                if ($this->image) {
                    // Hapus gambar lama
                    if ($gallery->image) {
                        Storage::disk('public')->delete($gallery->image);
                    }
                    // Simpan gambar baru
                    $data['image'] = $this->image->store('gallery', 'public');
                }

                $gallery->update($data);
                session()->flash('success', 'Galeri berhasil diperbarui.');
            } else {
                // Create
                $data = [
                    'keterangan' => $this->keterangan,
                    'image' => $this->image->store('gallery', 'public'),
                ];

                Gallery::create($data);
                session()->flash('success', 'Galeri berhasil ditambahkan.');
            }

            DB::commit();
            $this->resetForm();
            $this->loadGalleries();
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        $this->selectedGalleryId = $id;
        $this->keterangan = $gallery->keterangan;
        $this->imagePreview = $gallery->image ? Storage::url($gallery->image) : null;
    }

    public function delete($id)
    {
        try {
            $gallery = Gallery::findOrFail($id);
            if ($gallery->image) {
                Storage::disk('public')->delete($gallery->image);
            }
            $gallery->delete();
            session()->flash('success', 'Galeri berhasil dihapus.');
            $this->loadGalleries();
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menghapus galeri: ' . $e->getMessage());
        }
    }

    public function resetForm()
    {
        $this->reset(['image', 'keterangan', 'selectedGalleryId', 'imagePreview']);
    }

    public function render()
    {
        return view('livewire.bidan.data-gallery-page');
    }
}
