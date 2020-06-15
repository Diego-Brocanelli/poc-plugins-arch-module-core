<?php

namespace App\Module\Core\View\Components\Form;

class InputDate extends Input
{
    public $type = 'date';

    public function render()
    {
        return view('core::components.form.input');
    }
}
