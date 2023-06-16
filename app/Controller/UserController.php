<?php

namespace App\Controller;

use \App\Model\User;

class UserController
{
    public static function switchPassword($postPassword)
    {
        return password_hash($postPassword, PASSWORD_DEFAULT);
    }
    public static function cadastrar($postVars = [])
    {
        $_POST['password'] = self::switchPassword($_POST['password']);
        $user = new User($postVars['name'], $postVars['email'], $_POST['password'], $postVars['cellphone']);
        $user->cadastrar();
    }
}
