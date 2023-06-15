<?php
require 'vendor/autoload.php';

use \App\Http\Router;
use \App\Database\Database;

// $string = "200,00";
// $stringSemPontuacoes = explode('.', $string);

// print_r($stringSemPontuacoes);
// die;

//Defino minha URL do projeto
const URL = 'http://localhost/projetos/TestandoMvc';

//Criação do roteador
$objRouter = new Router($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
// $objDatabase = new Database('alunos');
// echo '<pre>';
// print_r($objDatabase);
// echo '</pre>';
// die;

//Rota Home
$objRouter->addRoute('/');

//Rota Formulário de cadastro
$objRouter->addRoute('/form');
$objRouter->addRoute('/avaliar');

//armazeno a rota acionada pelo usuário
$route = $objRouter->getRoute();

//executo a rota para entregar a view solicitada
$objRouter->run($route);
