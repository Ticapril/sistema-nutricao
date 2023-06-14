<?php

namespace App\Model;

//Model Exemplo
class Model
{
    public $string;

    public function __construct()
    {
        $this->string = 'Olá mundo!';
    }

    public function get_string()
    {
        return $this->string;
    }
}
