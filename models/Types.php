<?php
/**
 * Created by PhpStorm.
 * User: mehdy
 * Date: 20/06/17
 * Time: 02:09
 */

namespace Models;
use Models\Model as modelsModel;

class Types
{
    private $modelsModel = null;

    public function __construct()
    {
        $this->modelsModel = new modelsModel();
    }

    public function getTypes (){
        $pdo = $this->modelsModel->connectDB();
        if($pdo) {
            $sql = 'SELECT id AS typeId, name AS typeName FROM types';
            try {
                $pdoSt = $pdo->query($sql);
                return $pdoSt->fetchAll();
            }
            catch (PDOException $e){
                return '';
            }
        }else{
            die('Quelque chose a posé un problème lors de la récuprétation des types d\'entreprise.');
        }
    }
}