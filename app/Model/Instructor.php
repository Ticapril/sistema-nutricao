<?php

namespace App\Model;

use \App\Database\Database;
use \App\Model\Assessment;

class Instructor extends User
{
    //quantidadede avaliações feitas pelo instrutor
    private array $assessmentDone;

    //cria um novo instrutor
    public function create($values): void
    {
        $this->id = (new Database('instrutor'))->insert($values);
    }
    public function DoAssessment($postVars = [])
    {
        //instanciar um aluno e buscar na base e armazenar o id dele caso encontrado?
        // new Student()
        //instanciar um instrutor e buscar na base e armazenar o id dele caso encontrado?
        // new Instructor()
        $newAssessment = new Assessment($postVars); // cria uma nova avaliação como objeto
        $newAssessment->create($newAssessment); // seta o id da avaliação e armazena no banco de dados
        $this->assessmentDone[] = $newAssessment;
    }
}
