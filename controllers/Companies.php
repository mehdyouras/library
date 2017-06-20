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

    public function indexAll() {
        $this->modelsCompanies = new modelsCompanies();

        $companies = $this->modelsCompanies->getAllCompanies();

        if($companies) {
            $view = 'views/part/companyIndex.php';
            return compact('view', 'companies');
        }

        die('Il a eu un problème lors de l\'affichage des entreprises');
    }

    public function getUserCompanies() {
        $this->checkLogin();

        $this->modelsCompanies = new modelsCompanies();

        $companies = $this->modelsCompanies->getUserCompanies($_SESSION['user']->id);

        if($companies) {
            $view = 'views/part/companyIndex.php';
            return compact('companies', 'view');
        }

        die('Il a eu un problème lors de l\'affichage de vos entreprises');
    }

    public function getAddCompany() {
        $this->modelsTypes = new modelsTypes();
        $this->modelsLocalities = new modelsLocalities();

        $types = $this->modelsTypes->getTypes();
        $localities = $this->modelsLocalities->getLocalities();

        $view = 'views/part/addCompany.php';
        return compact('types', 'view', 'localities');
    }

    public function addCompany() {

        $details['name'] = $_POST['name'];
        $details['type'] = $_POST['type'];
        $details['locality'] = $_POST['locality'];
        $details['address'] = $_POST['address'];
        $details['description'] = $_POST['description'];

        if(isset($_FILES['img'])) {

        }
        if(!$_FILES['img']['error']) {
            $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
            if (in_array($_FILES['img']['type'], $allowedTypes)) {
                $typeParts = explode('/', $_FILES['img']['type']);
                $ext = '.' . $typeParts[count($typeParts) - 1];
                $sourceFile = $_FILES['img']['tmp_name'];
                $destFile = './assets/f' . time() . rand(1000, 9999) . $ext;
                $requiredWidth = 350;

                list($srcW, $srcH) = getimagesize($_FILES['img']['tmp_name']);
                $srcResource = imagecreatefromjpeg($_FILES['img']['tmp_name']);

                $ratio = $srcW/$requiredWidth;
                $destW = $srcW*$ratio;
                $destH = $srcH*$ratio;

                $destResource = imagecreatetruecolor($destW,$destH);
                imagecopyresampled($destResource, $srcResource, 0, 0, 0, 0, $destW, $destH, $srcW, $srcH);
                imagejpeg($destResource, $destFile, 100);

                $details['img'] = $destFile;
            }
        }
    }
}