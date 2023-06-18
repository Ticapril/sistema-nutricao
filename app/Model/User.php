<?php

namespace App\Model;

use \App\Database\Database;
use \PDO;

class User
{
    public int    $id;
    public string $name;
    public string $email;
    public string $password;
    public string $cellphone;
    public bool   $isAdm;

    // public function __construct(string $name, string $email, string $password, string $cellphone, bool $isAdm)
    // {
    //     $this->name = $name;
    //     $this->email = $email;
    //     $this->password = $password;
    //     $this->cellphone = $cellphone;
    //     $this->isAdm = $isAdm;
    // }


    public function cadastrar()
    {
        $obDatabase = new Database('usuario');
        $this->id = $obDatabase->insert([
            'name'      => $this->name,
            'email'     => $this->email,
            'password'  => $this->password,
            'cellphone' => $this->cellphone,
            'isAdm'     => $this->isAdm
        ]);
        return true;
    }
    public static function getUserByEmail($email)
    {
        return (new Database('usuario'))->select("email = '$email'")->fetchObject(self::class);
    }
}
