<?php

namespace App\Model;

// use \App\Model\Student;
use \App\Model\Exercise;
use \App\Database\Database;


class Assessment
{
    private $id = 1; // depois do insert
    private string $professor; // definido
    private string $date; // definido
    private Student $student; // definido
    private int $volumeTotal = 0;
    private array $exercises; // montar os exercicios

    public function setId($id)
    {
        $this->id = $id;
    }

    public function __construct($postVars)
    {
        $this->date = date('Y-m-d H:i:s');
        $this->student = $postVars['student'];
        $this->professor = $postVars['nome-professor'];
        $this->buildSerie($postVars);
        $this->calculateVolumeTotal();
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
        // echo '<pre>';
        // print_r($this->exercises);
        // echo '</pre>';
        // die;
        //
        // $this->exercises[] = new Exercise($postVars['nome'], $postVars['quantidade-serie'], $postVars['repeticoes'], $postVars['carga']);
    }
    //cria uma avaliação no banco de dados
    public function create($values): void
    {
        // echo '<pre>';
        // print_r($values);
        // echo '</pre>';
        // die;
        //crio um array associativo que envia os campos da tabela em questão
        $assesmentId = (new Database('avaliacao'))->insert([
            'professor' => $values->professor,
            'student' => $values->student->getId(),
            'date' => $values->date,
            'volumeTotal' => $values->volumeTotal,
        ]);
        $this->setId($assesmentId);
    }
    public function calculateVolumeTotal()
    {
        foreach ($this->exercises as $value) {
            $this->volumeTotal += $value->getVolume();
        }
    }
    // public function calculateVolume(Student $student)
    // {
    //     $this->volumeTotal = ($student->serie * $student->repetition * $this->intensity);
    // }
}
