<?php

namespace App\Module\Core\View\Components\Form;

class InputText extends Input
{
    public $type = 'text';

    public function render()
    {
        return view('core::components.form.input');
    }
}
