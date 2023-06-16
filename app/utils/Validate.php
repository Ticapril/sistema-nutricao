<?php

namespace App\Utils;

use App\Controller\StudentController;

//classe responsável por validar meus dados
class Validate
{
    public function verifyDataSend($postVars = [])
    {

        if ($postVars['name'] === '' && $postVars['height'] === '' && $postVars['weight'] === '') {
            return  StudentController::showData('Formulário Cadastro IMC', 'form', 'messageError');
        }
        return StudentController::showData('Formulário Cadastro IMC', 'form', 'Os dados foram enviados!');
    }
    public function 
}
