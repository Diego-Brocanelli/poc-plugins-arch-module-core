<?php

namespace App\Module\Core\View\Components\Form;

use Illuminate\View\Component;
use Illuminate\Support\Str;

class Input extends Component
{
    public $name;
    public $label;
    public $placeholder;
    public $help;
    public $mask;
    public $required;
    public $disabled;
    public $tipValid;
    public $tipInvalid;
    public $class;
    public $min;
    public $max;
    public $buttonLabel = 'Selecione';

    public function __construct(
        $name, $label = null, $placeholder = null, $help = null, $mask = null, $required = false, $disabled = false,
        $tipValid = null, $tipInvalid = null, $class = null, $min = null, $max = null, $buttonLabel = null
    ) {
        $this->name        = $name;
        $this->label       = $label ?? Str::ucfirst($this->name);
        $this->placeholder = $placeholder;
        $this->help        = $help;
        $this->mask        = $mask;
        $this->required    = (bool)$required;
        $this->disabled    = (bool)$disabled;
        $this->tipValid    = $tipValid;
        $this->tipInvalid  = $tipInvalid;
        $this->class       = $class;
        $this->min         = $min;
        $this->max         = $max;
        $this->buttonLabel = $buttonLabel;
    }

    public function render()
    {
        return view('core::components.form.input');
    }
}
