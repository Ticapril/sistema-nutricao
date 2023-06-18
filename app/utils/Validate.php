<?php

namespace App\Utils;

use App\Controller\StudentController;

//classe responsável por validar meus dados
class Validate
{
    //verifica se os campos vieram vazios
    public function verifyDataSend($postVars = [])
    {
        if ($postVars['name'] === '' || $postVars['height'] === '' || $postVars['weight'] === '') 
        {
            return  StudentController::showData('Formulário Cadastro IMC', 'form', 'messageError');
        }
        return StudentController::showData('Formulário Cadastro IMC', 'form', 'messageTest');
    }

    public function verifyTypeText($postVars = [])
    {
        //validação Nome
        $pattern = '/^(\p{L}+(?:\s\p{L}+)*)$/u';
        $result = [];
        if(gettype($postVars['name']) === 'string'){
            if(preg_match($pattern, $postVars['name'], $matches))
                $result['name'] = $matches[0];
        }
        return $result;
    }
    public function verifyTypeNumber($postVars = [])
    {
        $result = [];
        unset($postVars['name']);
        $pattern = '/[0-9]*/';
        $heightInt = intval($postVars['height']);
        $weigthFloat = floatval($postVars['weight']);
        $result['height'] = $heightInt;
        $result['weight'] = $weigthFloat;
        foreach ($result as $value) {
            if(gettype($value) === 'integer'){
                if(preg_match($pattern,$heightInt, $matches))
                    $result['height'] = intval($matches[0]);
            }elseif(gettype($value) === 'double'){
                if(preg_match($pattern,$weigthFloat, $matches))
                    $result['weight'] = floatval($matches[0]);
            }
        }
        return $result;
    }
    public function verifyTypeFields($postVars = [])
    {
        $result = [];
        $result['numeric'] = $this->verifyTypeNumber($postVars);
        $result['text'] = $this->verifyTypeText($postVars);
        return $result; 
    }
}
