<?php 

namespace App\Session;
use App\Controller\Home;
use App\Controller\StudentController;

class Login {



    private static function init(){
        if(session_status() !== PHP_SESSION_ACTIVE){
            session_start();
        }
    }

    public static function getUserLogged(){
        self::init();

        return self::isLogged() ? $_SESSION['user'] : null;
    }

    public static function login($obUser){
        self::init();
        //NAO UTILIZAR OBJETOS
        $_SESSION['user'] = [
            'id' => $obUser->id,
            'email' => $obUser->email,
            'password' => $obUser->password,
            'name' => $obUser->name,
            'cellphone' => $obUser->cellphone,
            'isAdm' => $obUser->isAdm,
        ];
        //redirect to index
        echo StudentController::getStudents('Mostrando dados Login');
        exit;
    }


    public static function isLogged(){
        self::init();
        return isset($_SESSION['user']['id']);
    }
    public static function requireLogin(){
        if(!self::isLogged()){
            header('location: login.php');
            exit;
        }
    }
    public static function requireLogout(){
        if(self::isLogged()){
            header('location: index.php');
            exit;
        }
    }
}