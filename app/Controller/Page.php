<?php

namespace App\Controller;

use \App\View\View;

class Page
{
    // criação de uma view Padrão 
    public static function getPage($title, $content)
    {
        return (new View('page'))->getResultContent([
            'title' => $title,
            'content_app' => $content,
        ]);
    }
}
