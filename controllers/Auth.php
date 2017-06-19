<?php
/**
 * Created by PhpStorm.
 * User: mehdy
 * Date: 19/06/17
 * Time: 19:46
 */

namespace controllers;
use \Models\Auth as ModelsAuth;

class Auth {
    private $authModel = null;

    public function __construct() {
        $this->authModel = new ModelsAuth();
    }

    public function getLogin() {
        if(isset($_SESSION['user'])) {
            header('Location: '.SITE_URL);
            die();
        }
        return ['view' => 'views/part/userLogin.php'];
    }

    public function checkLogin() {
        var_dump('test');
    }
}