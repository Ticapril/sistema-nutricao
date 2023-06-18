<?php 

require 'vendor/autoload.php';
use \App\Session\Login;
use \App\View\View;
use \App\Controller\Page;
use \App\Model\User;

Login::requireLogout();




if(isset($_POST['action'])){
   switch ($_POST['action']) {
    case 'logar':
        $obUser = User::getUserByEmail($_POST['email']);
        if(!$obUser instanceof User || !password_verify($_POST['password'], $obUser->password)){
            break;
        }
        Login::login($obUser);
        break;
    
    case 'cadastrar':
        if(isset($_POST['email'],$_POST['password'],$_POST['name'],$_POST['cellphone'],$_POST['isAdm'],)){
            $obUser = new User;
            $obUser->name = $_POST['name'];
            $obUser->email = $_POST['email'];
            $obUser->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $obUser->cellphone = $_POST['cellphone'];
            $obUser->isAdm = $_POST['isAdm'];
            $obUser->cadastrar();
        }
         break;
   }
}

$contentLogin =  (new View('login.html'))->getResultContent(); // renderiza a home sem passar nada
$header = (new View('header.php'))->getResultContent();
$footer = (new View('footer.php'))->getResultContent();
echo Page::getPage('Login Sistema', $contentLogin, $header, $footer);


// $view = new View('login.html');
// echo $view->getResultContent();
