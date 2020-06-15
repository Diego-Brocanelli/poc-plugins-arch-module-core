<?php

namespace App\Module\Core\View\Components\Form;

class InputEmail extends Input
{
    public $type = 'email';

    public function render()
    {
        return view('core::components.form.input');
    }
}
