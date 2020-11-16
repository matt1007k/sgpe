<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use Illuminate\Support\Str;

class PasswordGenerate extends Component
{
    public $password;

    public function passwordGenerate()
    {
        $this->password = Str::random(10);
    }
    public function render()
    {
        return view('livewire.users.password-generate');
    }
}
