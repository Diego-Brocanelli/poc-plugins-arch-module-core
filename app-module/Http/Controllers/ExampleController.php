<?php

declare(strict_types=1);

namespace App\Module\Core\Http\Controllers;

class ExampleController extends Controller
{
    public function show()
    {
        return view('module-core::test')->with([
            'title' => 'Teste Dois'
        ]);
    }
}
