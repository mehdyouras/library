<?php
/**
 * Created by PhpStorm.
 * User: mehdy
 * Date: 19/06/17
 * Time: 20:03
 */

namespace Controllers;
use Models\Companies as modelsCompanies;
use Models\Types as modelsTypes;
use Models\Localities as modelsLocalities;
use Controllers\Image as controllersImage;

class Companies extends Controller
{
    private $modelsCompanies = null;
    private $modelsTypes = null;
    private $modelsLocalities = null;
    private $controllersImage = null;

    public function indexAll() { // Affiche toutes les entreprises
        $this->modelsCompanies = new modelsCompanies();

        $companies = $this->modelsCompanies->getAllCompanies();

        if($companies) {
            $view = 'views/part/companyIndex.php';
            return compact('view', 'companies');
        }

        return ['view' => 'views/part/noCompany.php'];
    }

    public function getUserCompanies() { // Affiche toutes les entreprises liées à l'user connecté
        $this->checkLogin();
        $this->modelsCompanies = new modelsCompanies();

        $companies = $this->modelsCompanies->getUserCompanies($_SESSION['user']->id);

        if($companies) {
            $view = 'views/part/companyIndex.php';
            var_dump($companies);
            return compact('companies', 'view');
        }
        return ['view' => 'views/part/noCompany.php'];
    }

    public function getAddCompany() { // Récupère le formulaire pour ajouter une entreprise
        $this->checkLogin();
        $this->modelsTypes = new modelsTypes();
        $this->modelsLocalities = new modelsLocalities();


        $types = $this->modelsTypes->getTypes();
        $localities = $this->modelsLocalities->getLocalities();

        $view = 'views/part/addCompany.php';
        return compact('types', 'view', 'localities');
    }

    public function addCompany() { // Ajoute une entreprise
        $this->checkLogin();
        $this->modelsCompanies = new modelsCompanies();
        $this->controllersImage = new controllersImage();

        $details['name'] = $_POST['name'];
        $details['type'] = $_POST['type'];
        $details['locality'] = $_POST['locality'];
        $details['address'] = $_POST['address'];
        if(isset($_POST['description'])) {
            $details['description'] = $_POST['description'];
        }
        $details['img'] = $this->controllersImage->handleImageUpload('img');

        $lastInsertId = $this->modelsCompanies->addCompany($details);
        $this->modelsCompanies->linkUserCompany($_SESSION['user']->id, $lastInsertId);

        header('Location:'.SITE_URL.'/index.php?a=getUserCompanies&r=companies');
        exit;
    }

    public function removeCompany() {
        $this->checkLogin();
        $this->modelsCompanies = new modelsCompanies();

        $this->modelsCompanies->removeCompany($_POST['companyId']);
        header('Location:'.SITE_URL.'/index.php?a=getUserCompanies&r=companies');
    }

    public function getUpdateCompany() {
        $this->checkLogin();
        $this->modelsTypes = new modelsTypes();
        $this->modelsLocalities = new modelsLocalities();

        $types = $this->modelsTypes->getTypes();
        $localities = $this->modelsLocalities->getLocalities();
        $companiesList = $this->getUserCompanies();

        $companies = $companiesList['companies'];
        $view = $companiesList['view'];

        return compact('types', 'companies', 'view', 'localities');
    }

    public function updateCompany() {
        $this->checkLogin();
        $this->controllersImage = new controllersImage();

        $details['name'] = $_POST['name'];
        $details['type'] = $_POST['type'];
        $details['locality'] = $_POST['locality'];
        $details['address'] = $_POST['address'];
        if(isset($_POST['description'])) {
            $details['description'] = $_POST['description'];
        }
        $details['img'] = $this->controllersImage->handleImageUpload('img');

        header('Location:'.SITE_URL.'/index.php?a=getUserCompanies&r=companies');
        exit;
    }
}