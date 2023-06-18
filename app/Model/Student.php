<?php

namespace App\Model;

use \App\Database\Database;
use \App\Model\Assessment;

class Student extends User
{
    public int        $height; // constante
    public float      $weight; // varia a cada mes
    public Assessment $historyAssessment;

    //retorna o imc calculado 
    public function calculateImc(): string
    {
        return  round($this->weight / pow($this->height, 2) * 10000, 2);
    }
    // Avaliação implementa
    // public function validateHeight($height): int
    // {
    //     if (is_float($height)) {
    //         return $this->height = $height * 100;
    //     }
    //     return $this->height = $height;
    // }
    // criação de um novo aluno na base de dados
    public function create($values): void
    {
        $this->id = (new Database('usuario'))->insert($values);
    }
    // lista todos os alunos
    public static function select()
    {
        return (new Database('usuario'))->select()->fetchAll();
    }
    //busca um aluno pelo id
    public static function getStudentById($where, $order)
    {
        $db = (new Database('usuario'))->select($where, $order);
    }
}
