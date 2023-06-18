<?php

namespace App\Controller;

use \App\View\View;


//Somente um exemplo
class Home extends Page
{
    public static function getHome()
    {
        $contentHome =  (new View('professor'))->getResultContent(); // renderiza a home sem passar nada
        return parent::getPage('Professor Painel', $contentHome);
    }
}
