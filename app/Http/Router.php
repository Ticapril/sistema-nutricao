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
        $vetorUri = explode('TestandoMvc', $this->uri);
        foreach ($vetorUri as $value) {
            $route = $vetorUri[1];
            unset($value);
            continue;
        }
        return $route;
    }
    function addRoute($route, $methods = []): void
    {

        $this->routes[$route] = $methods;
        // $this->routes[$route] = function ($route) {
        //     // switch ($route) {
        //     //     case '/':
        //     //         // echo (new StudentController())->getStudents('Listagem Alunos IMC');
        //     //         // break;
        //     //     case '/form':
        //     //         // if ($this->method === 'POST') {
        //     //         //     $_POST['altura'] = StudentController::validateFields($_POST);
        //     //         //     StudentController::createStudent($_POST);
        //     //         //     (new StudentController())->getStudents('Listagem Alunos IMC');
        //     //         // } else
        //     //         //     StudentController::showData('Formulário Cadastro IMC', 'form');
        //     //         // break;
        //     //     case '/avaliar':
        //     //         // if ($this->method === 'POST') {
        //     //         //     $stdClass = (new AssessmentController())->getDataForm($_POST['nome-aluno']);
        //     //         //     $student = new Student($stdClass->id, $stdClass->nome, $stdClass->altura, $stdClass->peso);
        //     //         //     $_POST['student'] = $student;
        //     //         //     AssessmentController::createAssesment($_POST);
        //     //         // } else
        //     //         //     StudentController::showData('Formulário Avaliação Aluno', 'avaliar');
        //     //         // break;
        //     //     case '/login':
        //     //         // if ($this->method === 'POST') {

        //     //         //     if (isset($_POST['action'])) {

        //     //         //         switch ($_POST['action']) {
        //     //         //             case 'logar':
        //     //         //                 echo 'logou';
        //     //         //                 break;
        //     //         //             case 'cadastrar':
        //     //         //                 if (isset($_POST['name'], $_POST['email'], $_POST['cellphone'], $_POST['password']))
        //     //         //                     UserController::cadastrar($_POST);
        //     //         //                 break;
        //     //         //         }
        //     //         //     }
        //     //         // }
        //     // }
        // };
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
