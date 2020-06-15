<?php

namespace App\Module\Core\View\Components\Form;

use Illuminate\View\Component;
use Illuminate\Support\Str;

class Textarea extends Component
{
    public $name;
    public $label;
    public $placeholder;
    public $help;
    public $required;
    public $disabled;
    public $class;

    public function __construct(
        $name, $label = null, $placeholder = null, $help = null, $required = false, $disabled = false,
        $class = null
    ) {
        $this->name        = $name;
        $this->label       = $label ?? Str::ucfirst($this->name);
        $this->placeholder = $placeholder;
        $this->help        = $help;
        $this->required    = (bool)$required;
        $this->disabled    = (bool)$disabled;
        $this->class       = $class;
    }

    public function render()
    {
        return view('core::components.form.textarea');
    }
}
