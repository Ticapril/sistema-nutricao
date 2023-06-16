<?php
require 'vendor/autoload.php';

use \App\Http\Router;
use \App\Controller\StudentController;
use \App\Model\Instructor;
use \App\Utils\Validate;

//Defino minha URL do projeto
const URL = 'http://localhost/sistema-nutricao';

//Criação do roteador
$objRouter = new Router($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

//rota - /
// $methods = array(
//     'GET' => function () {
//         echo 'Buscar recurso';
//     },
//     'POST' => function ($resource) {
//         echo "Enviando recurso do tipo $resource";
//     },
//     'PUT' => function ($id) {
//         echo "Editar algum recurso pelo id = $id";
//     },
//     'DELETE' => function ($id) {
//         echo "Excluir algum recurso pelo id = $id";
//     },
// );

//rota - /form
$methods = array(
    'GET' => function () {
        echo StudentController::showData('Formulário Cadastro IMC', 'form', 'messageTest');
    },
    'POST' => function () {

        //validação completa desses dados
        // 1 - pente (todos os dados foram enviados?)
        // 2 - pente (o nome deve ser uma string e a altura e o peso devem ter somente numeros)
        if (isset($_POST['action'])) {
            $validator = new Validate();
            // 1 - pente (todos os dados foram enviados?)
            // echo $validator->verifyDataSend($_POST);
             // 2 - pente (o nome deve ser uma string e a altura e o peso devem ter somente numeros)
             $validator->verifyTypeFields($_POST);
        }
        die;

        // if ($_POST['action']) {
        //     echo 'cheguei';
        //     $validator = new Validate();
        //     $validator->verifyDataSend($_POST);
        //     die;
        // }


        //valida a altura passada
        $_POST['altura'] = StudentController::validateFields($_POST);
        //cria um novo aluno
        StudentController::createStudent($_POST);
        //retorna para a listagem de alunos da rota /
        (new StudentController())->select('Listagem Alunos IMC');
    },
);

//Rota Home
// $objRouter->addRoute('/', $methods);
// die;

//Rota Formulário de cadastro
$objRouter->addRoute('/form', $methods);
// die;
// $objRouter->addRoute('/avaliar');
// $objRouter->addRoute('/login');

//armazeno a rota acionada pelo usuário
$route = $objRouter->getRoute();

//executo a rota para entregar a view solicitada
$objRouter->run($route, $_SERVER['REQUEST_METHOD']);
