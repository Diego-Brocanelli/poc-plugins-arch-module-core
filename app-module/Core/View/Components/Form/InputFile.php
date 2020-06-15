<?php

namespace App\Module\Core\View\Components\Form;

class InputFile extends Input
{
    public $type = 'file';

    public function render()
    {
        return view('core::components.form.input');
    }
}
