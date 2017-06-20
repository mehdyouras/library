<?php
/**
 * Created by PhpStorm.
 * User: mehdy
 * Date: 19/06/17
 * Time: 19:52
 */

namespace Models;
use Models\Model as ModelsModel;

class Auth
{
    private $modelsModel = null;

    public function __construct()
    {
        $this->modelsModel = new ModelsModel();
    }

    public function checkUser($email, $password) {
        $pdo = $this->modelsModel->connectDB();

        if($pdo) {
            if ($pdo){
                $sql = 'SELECT * from users WHERE email = :email AND password = :password';
                try{
                    $pdoSt = $pdo->prepare($sql);
                    $pdoSt->execute([
                       ':email' => $email,
                       ':password' => $password
                    ]);
                    return $pdoSt->fetchAll();
                }catch (PDOException $e){
                    return '';
                }
            }else{
                die('Quelque chose a posé un problème lors de votre connexion.');
            }
        }
    }

    public function register($uniqid, $email, $password) {
        $pdo = $this->modelsModel->connectDB();

        if($pdo) {
            if ($pdo){
                $sql = 'INSERT INTO users(`id`, `email`, `password`)
                                          VALUES (:id, :email, :password)';
                try{
                    $pdoSt = $pdo->prepare($sql);
                    $pdoSt->execute([
                        ':id' => $uniqid,
                        ':email' => $email,
                        ':password' => $password
                    ]);
                }catch (PDOException $e){
                    return '';
                }
            }else{
                die('Quelque chose a posé un problème lors de votre inscription.');
            }
        }
    }
}