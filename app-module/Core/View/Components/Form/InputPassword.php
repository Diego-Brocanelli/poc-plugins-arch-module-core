<?php

namespace App\Module\Core\View\Components\Form;

class InputPassword extends Input
{
    public $type = 'password';

    public function render()
    {
        return view('core::components.form.input');
    }
}
