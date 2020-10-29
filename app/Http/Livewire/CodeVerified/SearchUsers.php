<?php

namespace App\Http\Livewire\CodeVerified;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SearchUsers extends Component
{
    public $dni, $code_verified, $user, $full_name;
    public $searched = false;

    public function searchUser(): void {
        $this->validate([
            'dni' => 'required',
            'code_verified' => 'required',
        ]);
        $this->searched = true;
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImptcmFtb3NyaW9zQGdtYWlsLmNvbSJ9.JsAfdKQ9A7aA5NXeNeXLW_IZJHKP715GpeZ2deAXMZ0';
        $url = "https://dniruc.apisperu.com/api/v1/dni/".$this->dni;

        $this->user = Http::get($url, ['token' => $token])->json();
        if(!empty($this->user)) $this->full_name = "{$this->user['nombres']} {$this->user['apellidoPaterno']} {$this->user['apellidoMaterno']}";
    }

    public function render()
    {
        return view('livewire.code-verified.search-users');
    }
}
