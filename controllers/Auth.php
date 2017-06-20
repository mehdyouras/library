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
        $user = $this->authModel->checkUser($_POST['email'], sha1($_POST['password']));
        if($user) {
            $_SESSION['user'] = $user[0];
            $_SESSION['success'][] = 'Vous vous êtes connecté avec succès !';
            header('Location:'.SITE_URL);
            exit;
        } elseif($_POST['email'] === '' || $_POST['password'] === '') {
            $_SESSION['error'][] = 'Veuillez remplir tous les champs.';
        } else {
            $_SESSION['error'][] = 'L\'adresse email ou le mot de passe est invalide';
            header('Location:'.SITE_URL.'/index.php?a=getLogin&r=auth');
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
        if(isset($_POST['email']) && ($_POST['password'] === $_POST['passwordCheck'])) {
            $_SESSION['success_message'][] = 'Votre compte a été créé avec succès. Vous pouvez dés à présent vous connecter.';
            $uniqid = uniqid();
            $email = $_POST['email'];
            $password = sha1($_POST['password']);
            $this->authModel->register($uniqid, $email, $password);
            header('Location:'.SITE_URL);
        } elseif(!isset($_POST) || !isset($_POST['password']) || !isset($_POST['passwordCheck'])) {
            $_SESSION['error'][] = 'Vérifiez les champs et réessayez.';
            return ['view' => 'views/part/registerUser.php'];
        } elseif ($_POST['password'] !== $_POST['passwordCheck']) {
            $_SESSION['error'][] = 'Les mots de passes de correspondent pas.';
            return ['view' => 'views/part/registerUser.php'];
        }

    }
}