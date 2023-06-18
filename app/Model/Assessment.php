<?php

namespace App\Model;

// use \App\Model\Student;
use \App\Model\Exercise;
use \App\Database\Database;


class Assessment
{
    private int     $id;  // id avaliação
    private int     $instructor_id;
    private string  $date; // data gerada automáticamente
    private int     $student_id; // id do aluno que vai fazer a avaliação
    private array   $exercises; // exercicios


    public function __construct($postVars)
    {
        $this->date = date('Y-m-d H:i:s');
        $this->student_id = $postVars['student']->id;
        $this->instructor_id = $postVars['nome-professor']->id;
        $this->buildSerie($postVars);
    }
    //monta a série
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
    // calcula o imc
    public function calculateImc(): string
    {
        return  round($this->weight / pow($this->height, 2) * 10000, 2);
    }
    public function calculateVolumeTotal()
    {
        $volumeTotal = 0;
        foreach ($this->exercises as $value) {
            $volumeTotal += $value->getVolume();
        }
        return $volumeTotal;
    }
    //cria uma avaliação no banco de dados
    // public function create($values): void
    // {
    //     $assesmentId = (new Database('avaliacao'))->insert([
    //         'professor_id'     =>  $values->professor,
    //         'student_id'       =>  $values->student->getId(),
    //         'date'             =>  $values->date,
    //     ]);
    //     $this->id = $assesmentId;
    // }
    //só calcula sem armazenar isso em lugar algum
    
}
