<?php

namespace App\Model;

use \App\Database\Database;
use \PDO;

abstract class User
{
    protected $id;
    protected string $name;
    protected string $email;
    protected string $password;
    protected string $cellphone;

    public function __construct(string $name, string $email, string $password, string $cellphone)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->cellphone = $cellphone;
    }


    public function cadastrar()
    {
        $obDatabase = new Database('public.usuario');
        $this->id = $obDatabase->insert([
            'name'      => $this->name,
            'email'     => $this->email,
            'password'  => $this->password,
            'cellphone' => $this->cellphone
        ]);
        return true;
    }
    public static function getUserByEmail($email)
    {
        return (new Database('public.usuario'))->select("email = '$email'")->fetchObject(self::class);
    }
}
