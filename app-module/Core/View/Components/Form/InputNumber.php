<?php

namespace App\Module\Core\View\Components\Form;

class InputNumber extends Input
{
    public $type = 'number';

    public function render()
    {
        return view('core::components.form.input');
    }
}
