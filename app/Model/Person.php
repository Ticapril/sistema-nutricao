<?php

//eu tenho um sistema vai ter uma tela que o usuário vai digitar dados para calculo de imc, eu vou ter um objeto desse usuário e vou armazenar essas informações dentro de um banco de dados e utilizar o mvc para fazer esse mini sisteminha
namespace App\Model;
//model tem acesso aos dados da aplicação
use \App\Database\Database;

class Student
{
    //atributos de classe definindo os tipos
    private string $id;
    private string $name;
    private int $height;
    private float $weight;

    //getters
    public function getId(): string
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getHeight(): int
    {
        return $this->height;
    }
    public function getWeight(): float
    {
        return $this->weight;
    }
    public function changeName($name): string
    {
        $reg = '/\{([^}]*)\}/';
        preg_match_all($reg, $name, $matches);
        $result = $matches[1];
        return $result[0];
    }

    public function __construct(string $id, string $name, int $height, float $weight)
    {
        $this->id = $id;
        $this->name = $name;
        $this->height = $height;
        $this->weight = $weight;
    }
    //retorna o imc calculado
    public function calculateImc(): string
    {
        return  round($this->weight / pow($this->height, 2) * 10000, 2);
    }
    //valida a altura caso o usuário digite pontos ou virgulas
    public function validateHeight($height): int
    {
        if (is_float($height)) {
            return $this->height = $height * 100;
        }
        return $this->height = $height;
    }
    //cria um novo aluno
    public function create($values): void
    {

        $db = new Database();
        $pdoObject = $db->setConnection();

        $this->id = strval($db->insertData($pdoObject, $values));
    }
    public static function getPersons()
    {
        $db = new Database();
        $connection = $db->setConnection();
        return $db->selectData($connection);
    }
}
