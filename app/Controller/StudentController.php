<?php

namespace App\Controller;

use \App\Model\Student;
use \App\View\View;

// O que essa classe faz?
// essa classe vai ter acesso a model Student, vai instanciar um objeto dessa model
// e enviar esses dados para serem renderizados em uma view ou receber esses dados da view e utilizar a model
// para cadastrar essa nova entidade no banco de dados

class StudentController extends Page
{
    public static function getStudentItens(): string
    {
        $students = '';
        $results = Student::select();
        echo '<pre>';
        print_r($results);
        echo '</pre>';
        die;
        $results ? $students = '' : $students = '<h4 class="text-center">Não existem students na base de dados</h4>';
        foreach ($results as  $values) {
            $student = new Student(intval($values->id), $values->nome, $values->altura, $values->peso, $values->serie = []);
            $students .= (new View('aluno/aluno'))->getResultContent([
                'id' => $student->getId(),
                'nome' => $student->changeName($student->getName()),
                'altura' => $student->getHeight(),
                'peso' => $student->getWeight(),
                'imc' => $student->calculateImc()
            ]);
        }
        return $students;
    }
    public static function getHeaderStudent()
    {
        return (new View('aluno/aluno_header'))->getResultContent();
    }
    // (pega os dados do formulário e envia via post para url /form) e cria um novo registro no banco de dados
    public static function getDataForm($postVars = []): Student
    {
        return new Student('aluno_' . strval(uniqid()), $postVars['nome'], $postVars['altura'], $postVars['peso'], $postVars);
    }
    public static function createStudent($postVars = []): void
    {
        //recebe uma instancia de Student
        $student = self::getDataForm($postVars);
        $student->create($postVars);
    }
    // renderiza uma página genérica ex: /form
    public static function showData($title, $viewName, $message)
    {
        $viewPage = new View($viewName);
        // echo '<pre>';
        // print_r($message);
        // echo '</pre>';
        // die;
        if ($message !== 'Preencha todos os dados') {
            $viewMessage = new View($message);

            return parent::getPage($title, $viewPage->getResultContent(), $viewMessage->getResultContent());
        }
        return parent::getPage($title, $viewPage->getResultContent(), '');
    }
    // renderiza uma página especifica ex: /
    public static function getStudents($title): void
    {
        $content = (new View('alunos'))->getResultContent([
            'alunos' => self::getStudentItens(),
            'header_alunos' => self::getHeaderStudent()
        ]);
        echo parent::getPage($title, $content);
    }

    public static function validateFields($values): string
    {
        //PRIMEIRA VALIDAÇÃO SE QUALQUER UM DOS CAMPOS ESTIVER VAZIO REDIRECIONA PARA A PÁGINA DE FORMULARIO
        foreach ($values as $value) {
            if (empty($value)) {
                header("Location: http://localhost/projetos/TestandoMvc/form");
                exit;
            }
        }

        //SEGUNDA VALIDAÇÃO É SE ALTURA ESTÃO SEM PONTOS E VIRGULAS
        $newHeight = [];
        if (strpos($values['altura'], '.')  !== false) {
            $newHeight = explode('.', $values['altura']);
            $values['altura'] = $newHeight[0];

            return $values['altura'];
        } else if (strpos($values['altura'], ',')  !== false) {
            $newHeight = explode(',', $values['altura']);

            $values['altura'] = $newHeight[0];
            return $values['altura'];
        }
        return $values['altura'];
    }
    // public static function getStudent($where)
    // {
    //     $student = Student::getStudent($name);
    //     return $student;
    // }
}
