<?php

namespace App\Module\Core\View\Components\Form;

class InputRange extends Input
{
    public $type = 'range';

    public function render()
    {
        return view('core::components.form.input');
    }
}
