<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;

class ShowStatus extends Component
{
    public $status;

    public function mount($status)
    {
        $this->status = $status;
    }

    public function render()
    {
        return view('livewire.users.show-status');
    }
}
