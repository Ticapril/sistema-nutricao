<?php

namespace App\Http;

use \App\Controller\StudentController;
use \App\Controller\AssessmentController;
use App\Model\Assessment;
use App\Model\Student;

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
        $serie = [];
        $this->routes[$route] = function ($route) {
            switch ($route) {
                case '/':
                    echo (new StudentController())->getStudents('Listagem Alunos IMC');
                    break;
                case '/form':
                    if ($this->method === 'POST') {
                        $_POST['altura'] = StudentController::validateFields($_POST);
                        StudentController::createStudent($_POST);
                        (new StudentController())->getStudents('Listagem Alunos IMC');
                    } else
                        StudentController::showData('Formulário Cadastro IMC', 'form');
                    break;
                case '/avaliar':
                    if ($this->method === 'POST') {
                        $stdClass = (new AssessmentController())->getDataForm($_POST['nome-aluno']);
                        // echo '<pre>';
                        // print_r($stdClass);
                        // echo '</pre>';
                        // die;
                        $student = new Student($stdClass->id, $stdClass->nome, $stdClass->altura, $stdClass->peso);
                        // echo '<pre>';
                        // print_r($student);
                        // echo '</pre>';
                        // die;
                        $_POST['student'] = $student;
                        AssessmentController::createAssesment($_POST);
                        // $_POST['altura'] = AssessmentController::validateFields($_POST);
                        // $serie['supino-reto'] = $_POST['supino-reto'];
                        // $serie['voador'] = $_POST['voador'];
                        // $serie['flexao'] = $_POST['flexao'];
                        // AssessmentController::createStudent($_POST, $serie);
                        // (new AssessmentController())->getStudent('Listagem Alunos IMC');
                    } else
                        StudentController::showData('Formulário Avaliação Aluno', 'avaliar');
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
