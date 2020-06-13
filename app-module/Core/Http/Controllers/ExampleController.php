<?php

declare(strict_types=1);

namespace App\Module\Core\Http\Controllers;

class ExampleController extends Controller
{
    public function __construct()
    {
        // Importante:
        // Sempre que sobrescrever o construtor é preciso invocar 
        // a sobrecarga, pois contém implementações originais do módulo
        parent::__construct();

        // Caso não precise mudar nada, o construtor pode ser removido daqui
    }

    public function show()
    {
        return view('core::examples.admin-form')->with([
            'title' => 'Formulário de Teste'
        ]);
    }
}
