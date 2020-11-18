<?php

namespace App\Http\Livewire\CodeVerified;

use App\Models\UserAttempt;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SearchUsers extends Component
{
    public $dni, $code_verified, $user, $full_name, $message_wait;
    public $searched = false;
    public $count = 1;
    public $time_wait = 0;
    public $open = false;

    public function mount(){
        $userAttempt = UserAttempt::where([
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ])->latest()->first();
        if($userAttempt){
            $this->getTimeForWait($userAttempt);
        }else{
            $this->count = 0;
        }
    }

    public function getTimeForWait(UserAttempt $userAttempt){
        $created_at = $userAttempt->created_at;
        $time = json_decode($userAttempt->payload)->wait_time;
        $new_time = \Carbon\Carbon::parse($created_at)->addMinutes($time);
        $this->time_wait = $new_time->format('i') - date('i');
        $this->message_wait = $this->getMessageWait(); 
        
        if($new_time > now()){
            $this->count = 3;
            $this->resetState();
        }else{
            $this->count = 0;
        }
    }

    public function getMessageWait(){
        $minutes = $this->getMessageWaitMinutes();

        return "Usted ha superado los 3 intentos. Por favor espere {$minutes} e inténtelo nuevamente.";
    }

    public function getMessageWaitMinutes(){
        if($this->time_wait != 1){
            return "{$this->time_wait} minutos";
        }else{
            return "{$this->time_wait} minuto";
        }
        return '';
    }

    public function searchUser(): void {
        $this->validate([
            'dni' => 'required',
            'code_verified' => 'required',
        ]);
        $this->searched = true;
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImptcmFtb3NyaW9zQGdtYWlsLmNvbSJ9.JsAfdKQ9A7aA5NXeNeXLW_IZJHKP715GpeZ2deAXMZ0';
        $url = "https://dniruc.apisperu.com/api/v1/dni/".$this->dni;

        $this->user = Http::get($url, ['token' => $token])->json();
        $this->full_name = $this->getFullName(); 
    }

    public function getFullName(){
        if(!empty($this->user)) 
            return "{$this->user['nombres']} {$this->user['apellidoPaterno']} {$this->user['apellidoMaterno']}"; 
        return "";
    }

    public function updated($values){
        if($values == 'code_verified'){
            if(!empty($this->user)) $this->count++;
            if($this->count === 3){
                $userAttempt = UserAttempt::create([
                    'ip_address' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                    'payload' => json_encode([
                        'wait_time' => '4'
                    ])
                ]);
                $this->getTimeForWait($userAttempt);
                $this->resetState();
                // dd("Usted ha superado los 3 intentos, intentelo más tarde.");
            }
        }
    }

    public function resetState(){
        $this->user = [];
        $this->dni = '';
        $this->full_name = '';
        $this->code_verified = '';
        $this->searched = false;
    }

    public function toggle(){
        $this->open = $this->open ? false : true;
    }

    public function render()
    {
        return view('livewire.code-verified.search-users');
    }
}
