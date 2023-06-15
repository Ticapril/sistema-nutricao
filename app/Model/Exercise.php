<?php

namespace App\Model;


class Exercise
{
    private $name; // nome do exercicio
    private $series; // quantas séries 1, 2 ou 3
    private $repetition; // quantidade de repetições
    private $intensity; // carga para cada repetição
    private $volume;

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
}
