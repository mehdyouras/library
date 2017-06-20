<?php
/**
 * Created by PhpStorm.
 * User: mehdy
 * Date: 20/06/17
 * Time: 02:36
 */

namespace Models;
use Models\Model as modelsModel;

class Localities
{
    private $modelsModel = null;

    public function __construct()
    {
        $this->modelsModel = new modelsModel();
    }

    public function getLocalities (){
        $pdo = $this->modelsModel->connectDB();
        if($pdo) {
            $sql = 'SELECT id AS localityId, name AS localityName FROM localities';
            try {
                $pdoSt = $pdo->query($sql);
                return $pdoSt->fetchAll();
            }
            catch (PDOException $e){
                return '';
            }
        }else{
            die('Quelque chose a posé un problème lors de la récuprétation des localités.');
        }
    }
}