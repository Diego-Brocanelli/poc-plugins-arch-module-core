<?php

namespace App\Module\Core\View\Components\Form;

use Illuminate\View\Component;
use Illuminate\Support\Str;

class Select extends Component
{
    public $name;
    public $label;
    public $placeholder;
    public $help;
    public $required;
    public $disabled;
    public $tipValid;
    public $tipInvalid;
    public $class;

    public function __construct(
        $name, $label = null, $placeholder = null, $help = null, $required = false, $disabled = false,
        $tipValid = null, $tipInvalid = null, $class = null
    ) {
        $this->name        = $name;
        $this->label       = $label ?? Str::ucfirst($this->name);
        $this->placeholder = $placeholder;
        $this->help        = $help;
        $this->required    = (bool)$required;
        $this->disabled    = (bool)$disabled;
        $this->tipValid    = $tipValid;
        $this->tipInvalid  = $tipInvalid;
        $this->class       = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('core::components.form.select');
    }
}
