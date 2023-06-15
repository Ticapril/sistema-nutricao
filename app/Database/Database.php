<?php

namespace App\Database;

use PDO;

//classe responsável por acessar ao banco de dados através de uma conexão executar métodos de insert(insere um aluno), update(edita um aluno), delete(deleta um aluno), select(exibe n alunos)
class Database
{
    const  HOST     = 'localhost';
    const  USER     = 'postgres';
    const  PASSWORD = 'root';
    const  PORT     = 5432;
    const  DBNAME   = 'testandomvc';
    private string $table;
    private PDO $connection;

    public function __construct(string $table)
    {
        $this->table = $table;
        $this->setConnection();
    }
    //contextos de orientação a objetos
    public function setConnection()
    {
        try {
            $this->connection = new PDO('pgsql:host=' . self::HOST . ';' . 'port=' . self::PORT . ';' . 'dbname=' . self::DBNAME, self::USER, self::PASSWORD);
        } catch (\PDOException $exception) {
            die($exception->getMessage());
        }
    }

    public function insert($values)
    {
        $fields = array_keys($values);
        echo '<pre>';
        print_r($fields);
        echo '</pre>';
        die;
        $result = $this->connection->prepare("INSERT INTO" . $this->table . "(id, nome, altura, peso) VALUES (?,?,?)");
        $result->bindValue(':id', $this->countData());
        $result->bindValue(':nome', '{' . $fields['nome'] . '}');
        $result->bindValue(':altura', $fields['altura']);
        $result->bindValue(':peso', $fields['peso']);
        $result->execute();
        return $this->countData();
    }
    public function selectData(): array
    {
        $result = $this->connection->prepare('SELECT * FROM alunos2');
        $result->execute();
        $rows = $result->fetchAll(PDO::FETCH_CLASS);
        return $rows;
    }
    public function selectDataByName($name)
    {
        $result = $this->connection->prepare("SELECT * FROM alunos2 WHERE nome = " . "'" . $name . "'");

        $result->execute();
        $row = $result->fetchAll(PDO::FETCH_CLASS);
        return $row;
    }
    // //refatorar isso aqui
    public function countData(): int
    {
        $result = $this->connection->prepare('SELECT * FROM alunos2');
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
}
