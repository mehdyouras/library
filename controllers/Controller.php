<?php
/**
 * Created by PhpStorm.
 * User: mehdy
 * Date: 20/06/17
 * Time: 01:44
 */

namespace controllers;


class Controller
{
    public function checkLogin() {
        if(!isset($_SESSION['user'])) {
            header('Location:'.SITE_URL);
            exit;
        }
    }
}