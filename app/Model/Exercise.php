<?php

namespace App\Model;

class Exercise
{
    private int    $id;
    private string $name;
    private int    $series; // quantidade de ciclos 1,2 ou 4
    private int    $repetition; // quantidade de repetições
    private int    $intensity; // carga 
    private int    $volume; // volume de treino

    public function getVolume()
    {
        return $this->volume;
    }
    public function __construct($name, $series, $repetition, $intensity)
    {
        $this->name = $name;
        $this->series = $series;
        $this->repetition = $repetition;
        $this->intensity = $intensity;
        $this->calculateVolume();
    }
    public function calculateVolume()
    {
        $this->volume = ($this->series * $this->repetition * $this->intensity);
    }
    public function showInfoExercise()
    {
        echo $this->name;
    }
}
