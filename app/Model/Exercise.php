<?php

namespace App\Model;

class Exercise
{
    private int    $id;
    private string $name;
    private int    $series;
    private int    $repetition;
    private int    $intensity;
    private int    $volume;

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
