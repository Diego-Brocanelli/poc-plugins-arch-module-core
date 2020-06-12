<?php

declare(strict_types=1);

namespace App\Module\Core\Http\Controllers;

class InfoController extends Controller
{
    public function show()
    {
        return view('module-core::info')->with([
            'current_module' => [] 
        ]);
    }
}
