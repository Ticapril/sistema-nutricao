<?php

namespace App\Controller;

use \App\View\View;


// Definição da página de erro
class ErrorController extends Page
{
    public static function getErrorPage()
    {
        $contentError =  (new View('error'))->getResultContent(); // renderiza a home sem passar nada
        return parent::getPage('Página de Erro', $contentError);
    }
}
