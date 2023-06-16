<?php

namespace App\Http;

use \App\Controller\StudentController;
use \App\Controller\LoginController;
use \App\Controller\UserController;
use \App\Controller\ErrorController;
use \App\Controller\AssessmentController;
use App\Model\Student;
use App\Model\User;

class Router
{
    // Atributos de classe
    private $method;
    private $uri;
    public  $routes;

    //Construtor
    public function __construct($method, $uri)
    {
        $this->method = $method;
        $this->uri = $uri;
    }
    function getRoute(): string
    {
        $vetorUri = explode('sistema-nutricao', $this->uri);
        foreach ($vetorUri as $value) {
            $route = $value;
            unset($value);
            continue;
        }
        return $route;
    }
    function addRoute($route, $methods = []): void
    {
        $this->routes[$route] = $methods;
    }
    //metodo responsável por verificar se a rota requisitada existe na classe Roter
    function run($route, $method): void
    {
        foreach ($this->routes as $key => $value) {
            if ($key === $route  && isset($this->routes[$key][$method])) {
                $this->routes[$key][$method]();
                exit;
            }
        }
        echo ErrorController::getErrorPage();
    }
}
