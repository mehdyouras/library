<?php
/**
 * Created by PhpStorm.
 * User: mehdy
 * Date: 19/06/17
 * Time: 19:46
 */

namespace Controllers;
use \Models\Auth as ModelsAuth;

class Auth {
    private $authModel = null;

    public function __construct() {
        $this->authModel = new ModelsAuth();
    }

    public function getLogin() {
        if(isset($_SESSION['user'])) {
            header('Location: '.SITE_URL);
            exit;
        }
        return ['view' => 'views/part/userLogin.php'];
    }

    public function checkLogin() {
        $_SESSION['email'] = $_POST['email'];
        $user = $this->authModel->checkUser($_POST['email'], $_POST['password']);
        if($user) {
            $_SESSION['user'] = $user[0];
            header('Location:'.SITE_URL);
            exit;
        }
        header('Location:'.SITE_URL.'/index.php?a=getLogin&r=auth');
        exit;
    }

    public function logout() {
        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
        header('Location:'.SITE_URL);
        exit;
    }

    public function getRegister() {
        if(isset($_SESSION['user'])) {
            header('Location: '.SITE_URL);
            exit;
        }
        return ['view' => 'views/part/registerUser.php'];
    }

    public function register() {

    }
}