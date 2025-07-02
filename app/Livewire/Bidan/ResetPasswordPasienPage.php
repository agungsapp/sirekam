<?php

namespace App\Livewire\Bidan;

use Livewire\Component;

class ResetPasswordPasienPage extends Component
{

    public $id;


    public function mount($id)
    {
        $this->id = $id;
    }





    public function render()
    {
        return view('livewire.bidan.reset-password-pasien-page');
    }
}
