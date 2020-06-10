<?php

declare(strict_types=1);

namespace App\Module\Core\Http\Controllers;

use App\Module\Core\Providers\Module;

class InfoController extends Controller
{
    public function show()
    {
        $module = Module::instance();
    
        return view('module-core::info')->with([
            'current_module' => $module->currentModule() 
        ]);
    }
}
