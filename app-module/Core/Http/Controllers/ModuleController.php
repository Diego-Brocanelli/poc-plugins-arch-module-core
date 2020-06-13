<?php

declare(strict_types=1);

namespace App\Module\Core\Http\Controllers;

use App\Module\Core\Libraries\Plugins\Handler;
use App\Module\Core\Providers\ServiceProvider;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class ModuleController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function __construct()
    {
        // Quando um controler é executado, o mecanismo de plugins é notificado
        // para poder desenhar os assets adequados na página HTML.
        Handler::instance()->setCurrentModule(ServiceProvider::class);
    }
}
