<?php

namespace App\View;

class View
{

    private string $resultContent;

    // busca o arquivo html e imprime na tela
    public function __construct($view)
    {
        $arrExplode = explode('.',$view); 
        // echo '<pre>';
        // print_r($arrExplode);
        // echo '</pre>';
        if($arrExplode[1] === 'html'){
            $this->resultContent = file_exists(self::searchFile($view)) ? file_get_contents(self::searchFile($view)) : 'Página não encontrada';
            // echo '<pre>';
            // print_r(self::searchFile($view));
            // echo '</pre>';
          
        }else {
            $this->resultContent = file_exists(self::searchIncludeFile($view)) ? file_get_contents(self::searchIncludeFile($view)) : 'Página não encontrada';
        }
    }
    //procura a view no diretorio de pastas do projeto
    public function searchFile($view): string
    {
        $file = __DIR__ . '/../../assets/pages/' . $view;
        return $file;
    }
    public function searchIncludeFile($view): string
    {
        $file = __DIR__ . '/../includes/' . $view;
        return $file;
    }

    public function getResultContent($vars = []): string
    {
        $keys = array_keys($vars);
        $keys =  array_map(function ($value) {
            return '{{' . $value . '}}';
        }, $keys);
        return str_replace($keys, array_values($vars), $this->resultContent);
    }
}
