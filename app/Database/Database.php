<?php

namespace App\Database;

use PDO;
//classe responsável por acessar ao banco de dados através de uma conexão executar métodos de insert(insere um aluno), update(edita um aluno), delete(deleta um aluno), select(exibe n alunos)
class Database
{
    //atributos
    private $host = 'localhost';
    private $name = 'testandomvc';
    private $user = 'postgres';
    private $password = 'root';
    private $port = 5432;

    public function insertData($pdoObject, $values): void
    {
        //monta a query
        $query = "INSERT INTO public.alunos(id, nome, altura, peso)VALUES (:id, :nome, :altura, :peso);";
        //prepara a query
        $result = $pdoObject->prepare($query);
        // binding de valores da query
        $result->bindValue(':id', $this->countData($pdoObject));
        $result->bindValue(':nome', '{' . $values['nome'] . '}');
        $result->bindValue(':altura', $values['altura']);
        $result->bindValue(':peso', $values['peso']);
        $result->execute();
    }
    public function selectData($pdoObject)
    {
        $query = 'SELECT * FROM alunos';
        $result = $pdoObject->prepare($query);
        $result->execute();
        $row = $result->fetchAll(PDO::FETCH_CLASS);
        return $row;
    }
    //refatorar isso aqui
    public function countData($pdoObject): int
    {
        $query = 'SELECT * FROM alunos';
        $result = $pdoObject->prepare($query);
        $result->execute();
        $row = $result->fetchAll(PDO::FETCH_ASSOC);
        return count($row);
    }
    // public function deleteData($pdoObject)
    // {
    // }
    // public function updateData($pdoObject)
    // {
    // }
    public function setConnection(): PDO
    {
        try {
            return new PDO("pgsql:host=$this->host;port=$this->port;dbname=$this->name", $this->user, $this->password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        } catch (\PDOException $exception) {
            die($exception->getMessage());
        }
    }
}
