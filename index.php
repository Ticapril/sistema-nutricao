<?php
require 'vendor/autoload.php';

use \App\Http\Router;

// $string = "200,00";
// $stringSemPontuacoes = explode('.', $string);

// print_r($stringSemPontuacoes);
// die;

//Defino minha URL do projeto
const URL = 'http://localhost/projetos/TestandoMvc';

//Criação do roteador
$objRouter = new Router($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

echo '<pre>';
print_r($objRouter->routes);
echo '</pre>';
die;

//Rota Home
$objRouter->addRoute('/');

//Rota Formulário de cadastro
$objRouter->addRoute('/form');

//armazeno a rota acionada pelo usuário
$route = $objRouter->getRoute();

//executo a rota para entregar a view solicitada
$objRouter->run($route);
