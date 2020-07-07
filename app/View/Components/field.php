<?php

namespace App\View\Components;

use Illuminate\View\Component;

class field extends Component
{
    public $name;
    public $type;
    public $label;
    public $help;

    public function __construct(string $name, string $type = 'text', string $label = null, string $help = null)
    {
        $this->name = $name;
        $this->type = $type;
        $this->label = $label;
        $this->help = $help;
    }

    public function render()
    {
        return view('components.field');
    }
}
