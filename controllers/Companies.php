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

    public function __construct()
    {
        $this->modelsCompanies = new modelsCompanies();
        $this->modelsTypes = new modelsTypes();
        $this->modelsLocalities = new modelsLocalities();
    }

    public function indexAll() { // Affiche toutes les entreprises

        $companies = $this->modelsCompanies->getAllCompanies();
        $types = $this->modelsTypes->getTypes();
        $localities = $this->modelsLocalities->getLocalities();

        if($companies) {
            $view = 'views/part/companyIndex.php';
            return compact('view', 'companies', 'types', 'localities');
        }

        return ['view' => 'views/part/noCompany.php'];
    }

    public function indexBy() {
        if($_GET['locality'] === 'all') {
            $locality = '';
        } else {
            $locality = $_GET['locality'];
        }

        if($_GET['type'] === 'all') {
            $type = '';
        } else {
            $type = $_GET['type'];
        }

        if($type === '' && $locality !== '') {
            $case = 1;
        } elseif ($type !== '' && $locality === '') {
            $case = 2;
        } elseif($type === '' && $locality === '') {
            $case = 3;
        }elseif($type !== '' && $locality !== '') {
            $case = 4;
        }

        $companies = $this->modelsCompanies->getCompaniesBy($type, $locality, $case);
        $types = $this->modelsTypes->getTypes();
        $localities = $this->modelsLocalities->getLocalities();
        $view = 'views/part/companyIndex.php';

        if(!$companies) {
            $_SESSION['error'] = 'Aucun résultat.';
        }

        return compact('companies', 'view', 'localities', 'types');
    }

    public function getUserCompanies() { // Affiche toutes les entreprises liées à l'user connecté
        $this->checkLogin();

        $companies = $this->modelsCompanies->getUserCompanies($_SESSION['user']->id);
        $types = $this->modelsTypes->getTypes();
        $localities = $this->modelsLocalities->getLocalities();

        if($companies) {
            $view = 'views/part/companyIndex.php';
            return compact('companies', 'view', 'localities', 'types');
        }
        return ['view' => 'views/part/noCompany.php'];
    }

    public function getCompany() {
        $company = $this->modelsCompanies->getCompany($_GET['companyId']);
        $company = $company[0];
        $view = 'views/part/singleCompany.php';

        return compact('view', 'company');
    }

    public function getAddCompany() { // Récupère le formulaire pour ajouter une entreprise
        $this->checkLogin();

        $types = $this->modelsTypes->getTypes();
        $localities = $this->modelsLocalities->getLocalities();

        $view = 'views/part/addCompany.php';
        return compact('types', 'view', 'localities');
    }

    public function addCompany() { // Ajoute une entreprise
        $this->checkLogin();
        $this->controllersImage = new controllersImage();

        if($_POST['name'] === '' || $_POST['type'] === '' || $_POST['locality'] === '' || $_POST['address'] === '' || $_POST['email'] === '' || $_POST['phone'] === '' || $_FILES['img'] === '') {
            $_SESSION['error'][] = 'Veuillez remplir tous les champs.';

            $_SESSION['name'] = $_POST['name'];
            $_SESSION['type'] = $_POST['type'];
            $_SESSION['locality'] = $_POST['locality'];
            $_SESSION['address'] = $_POST['address'];
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['phone'] = $_POST['phone'];
            $_SESSION['description'] = $_POST['description'];


        }

        $details['name'] = $_POST['name'];
        $details['type'] = $_POST['type'];
        $details['locality'] = $_POST['locality'];
        $details['address'] = $_POST['address'];
        $details['email'] = $_POST['email'];
        $details['phone'] = $_POST['phone'];

        if(isset($_POST['description'])) {
            $details['description'] = $_POST['description'];
        }
        $details['img'] = $this->controllersImage->handleImageUpload('img');

        if(isset($_SESSION['error'])) {
            header('Location:'.SITE_URL.'/index.php?a=getAddCompany&r=companies');
            exit;
        }

        $lastInsertId = $this->modelsCompanies->addCompany($details);
        $this->modelsCompanies->linkUserCompany($_SESSION['user']->id, $lastInsertId);

        header('Location:'.SITE_URL.'/index.php?a=getUserCompanies&r=companies');
        exit;
    }

    public function removeCompany() {
        $this->checkLogin();

        $this->modelsCompanies->removeCompany($_POST['companyId']);
        header('Location:'.SITE_URL.'/index.php?a=getUserCompanies&r=companies');
    }

    public function getUpdateCompany() {
        $this->checkLogin();

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
        $details['email'] = $_POST['email'];
        $details['phone'] = $_POST['phone'];

        if(isset($_POST['description'])) {
            $details['description'] = $_POST['description'];
        }
        $details['img'] = $this->controllersImage->handleImageUpload('img');

        header('Location:'.SITE_URL.'/index.php?a=getUserCompanies&r=companies');
        exit;
    }
}