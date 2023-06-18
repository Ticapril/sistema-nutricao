<?php

namespace App\Controller;

use \App\View\View;

class Page
{
    //metodo responsável por exibir página padrão não da pra utilizar sobrescrita de método em php coisa bonita
    public static function getPage($title, $content, $header, $footer)
    {
        return (new View('page.html'))->getResultContent([
            'title' => $title,
            'content_app' => $content,
            'header' => $header,
            'footer' => $footer
        ]);
    }
    //metodo responsável por exibir somente páginas de formulário
    public static function getFormPage($title, $content, $message)
    {
        return (new View('page.html'))->getResultContent([
            'title' => $title,
            'content_app' => $content,
            'content_message' => $message
        ]);
    }
}
