<?php
/**
 * Created by PhpStorm.
 * User: mehdy
 * Date: 19/06/17
 * Time: 20:03
 */

namespace controllers;
use Models\Companies as modelsCompanies;

class Companies
{
    private $modelsCompanies = null;

    public function indexAll() {
        $this->modelsCompanies = new modelsCompanies();

        $companies = $this->modelsCompanies->getAllCompanies();

        if($companies) {
            $view = 'views/part/allCompanies.php';
            return compact('view', 'companies');
        }

        die('Il a eu un problème lors de l\'affichage des entreprises');
    }
}