<?php

namespace App\Http;

use \App\Controller\PersonController;

class Router
{
    // Atributos de classe
    private $method;
    private $uri;
    public  $routes = [[]];

    //Construtor
    public function __construct($method, $uri)
    {
        $this->method = $method;
        $this->uri = $uri;
    }
    function getRoute(): string
    {
        $vetorUri = explode('TestandoMvc', $this->uri);
        foreach ($vetorUri as $value) {
            $route = $vetorUri[1];
            unset($value);
            continue;
        }
        return $route;
    }
    function addRoute($route): void
    {
        $this->routes[$route] = function ($route) {
            switch ($route) {
                case '/':
                    echo (new PersonController())->getPersons('Listagem Alunos IMC');
                    break;
                case '/form':
                    if ($this->method === 'POST') {
                        $_POST['altura'] = PersonController::validateFields($_POST);
                        // echo '<pre>';
                        // print_r($_POST['altura']);
                        PersonController::createPerson($_POST);
                        (new PersonController())->getPersons('Listagem Alunos IMC');
                    } else
                        PersonController::showData('Formulário Cadastro IMC', 'form');
                    break;
            }
        };
    }
    function run($route): void
    {
        foreach ($this->routes as $key => $value) {
            if ($key === $route) {
                $value($route);
                exit;
            }
        }
        echo 'URL NÃO ENCONTRADA';
    }
}
