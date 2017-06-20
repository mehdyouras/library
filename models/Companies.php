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
                $sql = 'SELECT  companies.id as companyId,
                                companies.name as companyName,
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

    public function getUserCompanies($userId) {
        $this->modelsModel = new modelsModel();
        $pdo = $this->modelsModel->connectDB();
        if($pdo) {
            if ($pdo){
                $sql = 'SELECT  companies.id as companyId,
                                companies.name as companyName,
                                types.id as companyTypeId,
                                types.name as companyType,
                                localities.id as companyLocalityId,
                                localities.name as companyLocality,
                                companies.streetAddress as companyAddress,
                                companies.img as companyImg,
                                companies.description as companyDescription
                                FROM user_company
                                LEFT JOIN companies ON user_company.company_id = companies.id 
                                LEFT JOIN types ON companies.type = types.id
                                LEFT JOIN localities ON companies.locality = localities.id 
                                WHERE user_company.user_id = :userId;';
                try{
                    $pdoSt = $pdo->prepare($sql);
                    $pdoSt->execute([
                        ':userId' => $userId
                    ]);
                    return $pdoSt->fetchAll();
                }catch (PDOException $e){
                    return '';
                }
            }else{
                die('Quelque chose a posé un problème lors de la récuprétation des entreprises.');
            }
        }
    }

    public function addCompany($details) {
        $this->modelsModel = new modelsModel();
        $pdo = $this->modelsModel->connectDB();

        if($pdo) {
            $sql = 'INSERT INTO companies(`name`, `type`, `locality`, `streetAddress`, `img`, `description`)
                                          VALUES (:name, :type, :locality, :streetAddress, :img, :description)';
            try{
                $pdoSt = $pdo->prepare($sql);
                $pdoSt->execute([
                    ':name' => $details['name'],
                    ':type' => $details['type'],
                    ':locality' => $details['locality'],
                    ':streetAddress' => $details['address'],
                    ':img' => $details['img'],
                    ':description' => $details['description']
                ]);
                return $pdo->lastInsertId();
            }catch (PDOException $e){
                return '';
            }
        }else{
            die('Quelque chose a posé un problème lors de la récuprétation des entreprises.');
        }
    }

    public function linkUserCompany($userId, $companyId) {
        $this->modelsModel = new modelsModel();
        $pdo = $this->modelsModel->connectDB();

        if($pdo) {
            $sql = 'INSERT INTO user_company(`user_id`, `company_id`)
                                          VALUES (:userId, :companyId)';
            try{
                $pdoSt = $pdo->prepare($sql);
                $pdoSt->execute([
                    ':userId' => $userId,
                    ':companyId' => $companyId
                ]);
            }catch (PDOException $e){
                return '';
            }
        }else{
            die('Quelque chose a posé un problème lors de la récuprétation des entreprises.');
        }
    }

    public function removeCompany($companyId) {
        $this->modelsModel = new modelsModel();
        $pdo = $this->modelsModel->connectDB();

        if($pdo) {
            $sql = 'DELETE FROM companies WHERE id = :companyId;
                    DELETE FROM user_company WHERE company_id = :companyId';
            try{
                $pdoSt = $pdo->prepare($sql);
                $pdoSt->execute([
                    ':companyId' => $companyId
                ]);
            }catch (PDOException $e){
                return '';
            }
        }else{
            die('Quelque chose a posé un problème lors de la récuprétation des entreprises.');
        }
    }

    public function updateCompany() {
        $this->modelsModel = new modelsModel();
        $pdo = $this->modelsModel->connectDB();

        if($pdo) {
            $sql = 'UPDATE `library`.`companies` SET 
                            `name`=\'test\',
                            `type`=\'2\',
                            `locality`=\'2\',
                            `streetAddress`=\'nklkvnkpz,vk\',
                            `img`=\'./assets/f149794984069.png\',
                            `description`=\'bjvzzbvnjozvbjvnolknzv\'
                            WHERE `id`=\'7\';
';
            try{
                $pdoSt = $pdo->prepare($sql);
                $pdoSt->execute([
                    ':companyId' => $companyId
                ]);
            }catch (PDOException $e){
                return '';
            }
        }else{
            die('Quelque chose a posé un problème lors de la récuprétation des entreprises.');
        }
    }
}