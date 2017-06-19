<?php
/**
 * Created by PhpStorm.
 * User: mehdy
 * Date: 19/06/17
 * Time: 20:16
 */

namespace Models;
use Models\Model as modelsModel;

class Companies
{
    private $modelsModel = null;
    public function getAllCompanies() {
        $this->modelsModel = new modelsModel();
        $pdo = $this->modelsModel->connectDB();
        if($pdo) {
            if ($pdo){
                $sql = 'SELECT  companies.name as companyName,
                                types.name as companyType,
                                localities.name as companyLocality,
                                companies.streetAddress as companyAddress,
                                companies.img as companyImg
                                FROM companies
                                LEFT JOIN types ON companies.type = types.id
                                LEFT JOIN localities ON companies.locality = localities.id';
                try{
                    $pdoSt = $pdo->query($sql);
                    return $pdoSt->fetchAll();
                }catch (PDOException $e){
                    return '';
                }
            }else{
                die('Quelque chose a posé un problème lors de la récuprétation des entreprises.');
            }
        }
    }
}