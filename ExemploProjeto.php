<?php

//metodo que recebe um array genérico e retorna uma média
function getAverage($arrModified, $arrOrigin)
{
    return number_format((count($arrModified) / count($arrOrigin)), 6);
}
function printAverage($average)
{
    echo "$average\n";
}
function testeStringsPhp()
{
    $teste = 'ola mundo';
    echo "$teste Newm" . '</br>';
    echo '$teste Newm';
}


function plusMinus($arr): void
{
    $arrNegatives = [];
    $arrPositives = [];
    $arrZeros     = [];

    //+ - / %
    foreach ($arr as $value) {
        if ($value < 0) // != !== === == <= >= !
            $arrNegatives[] = $value;
        else if ($value > 0)
            $arrPositives[] = $value;
        else
            $arrZeros[]    = $value;
    }
    // $averageNegative = getAverage($arrNegatives, $arr);
    // $averagePositive = getAverage($arrPositives, $arr);
    // $averageZeros = getAverage($arrZeros, $arr);
    // echo $averagePositive . "\n";
    // echo $averageNegative . "\n";
    // echo $averageZeros . "\n";
    printAverage(getAverage($arrPositives, $arr));
    printAverage(getAverage($arrNegatives, $arr));
    printAverage(getAverage($arrZeros, $arr));
}
// $arr = [-4, 3, -9, 0, 4, 1];
// plusMinus($arr);
// plusMinus([-4, 3, -9, 0, 4, 1]);
testeStringsPhp();

//Baixando bibliotecas e utilitários para o projeto
// composer require twbs/bootstrap:5.3.0
