<?php

namespace App\Model;

// use \App\Model\Student;
use \App\Model\Exercise;
use \App\Database\Database;


class Assessment
{
    private int     $id; // depois do insert
    private int     $instructor_id; // definido fk
    private string  $date; // definido
    private int     $student_id; // definido fk
    private array   $exercises; // montar os exercicios


    public function __construct($postVars)
    {
        $this->date = date('Y-m-d H:i:s');
        $this->student_id = $postVars['student']->id;
        $this->instructor_id = $postVars['nome-professor']->id;
        $this->buildSerie($postVars);
    }
    //recebe da view /avaliar-aluno dados via Post dos exercicios para o aluno especifico
    public function buildSerie(array $postVars = [])
    {
        //removo as posições que não me interessa
        unset($postVars['nome-professor']);
        unset($postVars['nome-aluno']);
        unset($postVars['student']);

        $varsVolume['quantidade-repeticoes'] = $postVars['quantidade-repeticoes'];
        $varsVolume['numero-series'] = $postVars['numero-series'];
        $varsVolume['carga-media'] = $postVars['carga-media'];

        unset($postVars['quantidade-repeticoes']);
        unset($postVars['numero-series']);
        unset($postVars['carga-media']);

        foreach ($postVars as $key => $value) {
            $this->exercises[] = new Exercise($key, $varsVolume['numero-series'], $varsVolume['quantidade-repeticoes'], $varsVolume['carga-media']);
        }
    }
    //cria uma avaliação no banco de dados
    public function create($values): void
    {
        $assesmentId = (new Database('avaliacao'))->insert([
            'professor_id'     =>  $values->professor,
            'student_id'       =>  $values->student->getId(),
            'date'             =>  $values->date,
        ]);
        $this->id = $assesmentId;
    }
    //só calcula sem armazenar isso em lugar algum
    public function calculateVolumeTotal()
    {
        $volumeTotal = 0;
        foreach ($this->exercises as $value) {
            $volumeTotal += $value->getVolume();
        }
        return $volumeTotal;
    }
}
