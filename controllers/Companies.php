<?php
/**
 * Created by PhpStorm.
 * User: mehdy
 * Date: 19/06/17
 * Time: 20:03
 */

namespace controllers;
use Models\Companies as modelsCompanies;
use Models\Types as modelsTypes;
use Models\Localities as modelsLocalities;

class Companies
{
    private $modelsCompanies = null;
    private $modelsTypes = null;
    private $modelsLocalities = null;

    public function indexAll() { // Affiche toutes les entreprises
        $this->modelsCompanies = new modelsCompanies();

        $companies = $this->modelsCompanies->getAllCompanies();

        if($companies) {
            $view = 'views/part/companyIndex.php';
            return compact('view', 'companies');
        }

        die('Il a eu un problème lors de l\'affichage des entreprises');
    }

    public function getUserCompanies() { // Affiche toutes les entreprises liées à l'user connecté
        $this->modelsCompanies = new modelsCompanies();

        $companies = $this->modelsCompanies->getUserCompanies($_SESSION['user']->id);

        if($companies) {
            $view = 'views/part/companyIndex.php';
            return compact('companies', 'view');
        }

        die('Il a eu un problème lors de l\'affichage de vos entreprises');
    }

    public function getAddCompany() { // Récupère le formulaire pour ajouter une entreprise
        $this->modelsTypes = new modelsTypes();
        $this->modelsLocalities = new modelsLocalities();


        $types = $this->modelsTypes->getTypes();
        $localities = $this->modelsLocalities->getLocalities();

        $view = 'views/part/addCompany.php';
        return compact('types', 'view', 'localities');
    }

    public function addCompany() { // Ajoute une entreprise
        $this->modelsCompanies = new modelsCompanies();

        $details['name'] = $_POST['name'];
        $details['type'] = $_POST['type'];
        $details['locality'] = $_POST['locality'];
        $details['address'] = $_POST['address'];
        if(isset($_POST['description'])) {
            $details['description'] = $_POST['description'];
        }
        $details['img'] = null;

        if(isset($_FILES['img'])) {
            if(!$_FILES['img']['error']) {
                $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                if (in_array($_FILES['img']['type'], $allowedTypes)) {
                    $typeParts = explode('/', $_FILES['img']['type']);
                    $ext = '.' . $typeParts[count($typeParts) - 1];
                    $sourceFile = $_FILES['img']['tmp_name'];
                    $destFile = './assets/f' . time() . rand(1000, 9999) . $ext;
                    $requiredWidth = 350;

                    list($srcW, $srcH) = getimagesize($_FILES['img']['tmp_name']);

                    if($_FILES['img']['type'] === 'image/png') {
                        $srcResource = imagecreatefrompng($_FILES['img']['tmp_name']);
                    } else {
                        $srcResource = imagecreatefromjpeg($_FILES['img']['tmp_name']);
                    }

                    $ratio = $requiredWidth/$srcW;
                    $destW = $srcW*$ratio;
                    $destH = $srcH*$ratio;

                    $destResource = imagecreatetruecolor($destW,$destH);
                    imagecopyresampled($destResource, $srcResource, 0, 0, 0, 0, $destW, $destH, $srcW, $srcH);

                    if($_FILES['img']['type'] === 'image/png') {
                        imagepng($destResource, $destFile, 9);
                    } else {
                        imagejpeg($destResource, $destFile, 100);
                    }

                    $details['img'] = $destFile;
                }
            }
        }

        $lastInsertId = $this->modelsCompanies->addCompany($details);
        $this->modelsCompanies->linkUserCompany($_SESSION['user']->id, $lastInsertId);

        header('Location:'.SITE_URL.'/index.php?a=getUserCompanies&r=companies');
        exit;
    }
}