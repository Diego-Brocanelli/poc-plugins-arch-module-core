<?php

namespace App\Module\Core\View\Components\Form;

class InputTime extends Input
{
    public $type = 'time';

    public function render()
    {
        return view('core::components.form.input');
    }
}
