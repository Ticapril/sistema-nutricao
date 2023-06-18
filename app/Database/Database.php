<?php

namespace App\Database;

use PDO;
use PDOException;

//classe responsável por acessar ao banco de dados através de uma conexão executar métodos de insert(insere um aluno), update(edita um aluno), delete(deleta um aluno), select(exibe n alunos)
class Database
{
    const  HOST     = 'localhost';
    const  USER     = 'root';
    const  PASSWORD = '';
    const  PORT     = 3306;
    const  NAME   = 'sistema-nutricao';
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
            $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME,self::USER,self::PASSWORD);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $exception) {
            die($exception->getMessage());
        }
    }
    public function execute($query, $params = [])
    {
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            return $statement;
        } catch (PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }
    }
    public function insert($values)
    {
        //DADOS DA QUERY
        $fields = array_keys($values);
        $binds  = array_pad([], count($fields), '?');
        $query = 'INSERT INTO ' . $this->table . ' (' . implode(',', $fields) . ') VALUES (' . implode(',', $binds) . ')';
        $this->execute($query, array_values($values));
        return $this->connection->lastInsertId();
    }
    public function selectUserByEmail($email)
    {
        $query = "SELECT * FROM $this->table WHERE email = '$email'";

        $result = $this->connection->prepare($query);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_CLASS);
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
    public function select($where = null, $order = null, $limit = null, $fields = '*')
    {
        //DADOS DA QUERY
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

        //MONTA A QUERY
        $query = 'SELECT ' . $fields . ' FROM ' . $this->table . ' ' . $where . ' ' . $order . ' ' . $limit;

        //EXECUTA A QUERY
        return $this->execute($query);
    }
}
