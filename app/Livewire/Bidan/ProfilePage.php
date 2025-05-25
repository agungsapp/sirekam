<?php

namespace App\Livewire\Bidan;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProfilePage extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $nip;
    public $no_hp;
    public $image;
    public $current_image;
    public $password;
    public $password_confirmation;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->nip = $user->nip;
        $this->no_hp = $user->no_hp;
        $this->current_image = $user->image;
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
            'nip' => ['nullable', 'string', 'max:50'],
            'no_hp' => ['nullable', 'string', 'max:15', 'regex:/^(\+62|0)[0-9]{9,12}$/'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'], // Maks 2MB
        ]);

        try {
            DB::beginTransaction();

            $user = Auth::user();
            $data = [
                'name' => $this->name,
                'email' => $this->email,
                'nip' => $this->nip,
                'no_hp' => $this->no_hp,
            ];

            if ($this->image) {
                // Hapus gambar lama jika ada dan bukan default.png
                if ($user->image && $user->image !== 'profile/default.png' && Storage::exists('public/' . $user->image)) {
                    Storage::delete('public/' . $user->image);
                }
                // Simpan gambar baru
                $data['image'] = $this->image->store('profile', 'public');
            }

            $user->update($data);

            DB::commit();
            session()->flash('success', 'Profil berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Gagal memperbarui profil: ' . $e->getMessage());
        }
    }

    public function updatePassword()
    {
        $this->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        try {
            DB::beginTransaction();

            $user = Auth::user();
            $user->update([
                'password' => Hash::make($this->password),
            ]);

            DB::commit();
            $this->reset(['password', 'password_confirmation']);
            session()->flash('success', 'Kata sandi berhasil diubah!');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Gagal mengubah kata sandi: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.bidan.profile-page');
    }
}
