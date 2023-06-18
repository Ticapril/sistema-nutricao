<?php

namespace App\Controller;

use \App\View\View;


//Somente um exemplo
class TesteController extends Page
{
    public static function getHome()
    {
        $content =  (new View('professor.html'))->getResultContent(); // renderiza a home sem passar nada
        $header =   (new View('header.php'))->getResultContent();
        $footer =   (new View('header.php'))->getResultContent();
        return parent::getPage('Professor Painel', $content,$header, $footer);
    }
}
