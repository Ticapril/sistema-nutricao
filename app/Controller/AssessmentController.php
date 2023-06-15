<?php

namespace App\Controller;

use \App\Model\Assessment;
use \App\View\View;
use \App\Model\Student;

// O que essa classe faz?
// essa classe vai ter acesso a model Student, vai instanciar um objeto dessa model
// e enviar esses dados para serem renderizados em uma view ou receber esses dados da view e utilizar a model
// para cadastrar essa nova entidade no banco de dados

class AssessmentController extends Page
{
    // public static function getStudentItens(): string
    // {
    //     $alunos = '';
    //     $results = Student::getStudents();
    //     $results ? $alunos = '' : $alunos = '<h4 class="text-center">Não existem alunos na base de dados</h4>';
    //     foreach ($results as  $values) {
    //         $aluno = new Student($values->id, $values->nome, $values->altura, $values->peso, $values->serie = []);
    //         $alunos .= (new View('aluno/aluno'))->getResultContent([
    //             'id' => $aluno->getId(),
    //             'nome' => $aluno->changeName($aluno->getName()),
    //             'altura' => $aluno->getHeight(),
    //             'peso' => $aluno->getWeight(),
    //             'imc' => $aluno->calculateImc()
    //         ]);
    //     }
    //     return $alunos;
    // }
    // public static function getHeaderStudent()
    // {
    //     return (new View('aluno/aluno_header'))->getResultContent();
    // }
    public static function getDataForm($postVars = [])
    {

        $student = StudentController::getStudent($postVars);
        if (!empty($student)) {
            // echo '<pre>';
            // print_r($student[0]);
            // echo '</pre>';
            // die;
            // echo 'O aluno foi encontrado';
            return $student[0];
        }
        // } else {
        //     StudentController::showData('Formulário Avaliação Aluno', 'avaliar');
        // }
    }
    public static function createAssesment($postVars = []): void
    {
        //recebe uma instancia de Student
        // $student = self::getDataForm($postVars);
        $assesment = new Assessment($postVars);
        $assesment->create($assesment);
        // echo '<pre>';
        // print_r($assesment);
        // echo '</pre>';
        // die;
        // $student->create($postVars);
    }
    // // renderiza uma página genérica ex: /form
    // public static function showData($title, $viewName): void
    // {
    //     $view = new View($viewName);
    //     echo parent::getPage($title, $view->getResultContent());
    // }
    // // renderiza uma página especifica ex: /
    // public static function getStudents($title): void
    // {
    //     $content = (new View('alunos'))->getResultContent([
    //         'alunos' => self::getStudentItens(),
    //         'header_alunos' => self::getHeaderStudent()
    //     ]);
    //     echo parent::getPage($title, $content);
    // }
    // public static function validateFields($values): string
    // {
    //     //PRIMEIRA VALIDAÇÃO SE QUALQUER UM DOS CAMPOS ESTIVER VAZIO REDIRECIONA PARA A PÁGINA DE FORMULARIO
    //     foreach ($values as $value) {
    //         if (empty($value)) {
    //             header("Location: http://localhost/projetos/TestandoMvc/form");
    //             exit;
    //         }
    //     }

    //     //SEGUNDA VALIDAÇÃO É SE ALTURA ESTÃO SEM PONTOS E VIRGULAS
    //     $newHeight = [];
    //     if (strpos($values['altura'], '.')  !== false) {
    //         $newHeight = explode('.', $values['altura']);
    //         $values['altura'] = $newHeight[0];

    //         return $values['altura'];
    //     } else if (strpos($values['altura'], ',')  !== false) {
    //         $newHeight = explode(',', $values['altura']);

    //         $values['altura'] = $newHeight[0];
    //         return $values['altura'];
    //     }
    //     return $values['altura'];
    // }
}
