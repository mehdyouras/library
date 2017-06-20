<?php
return [
    'default'           => 'GET/companies/indexAll',

    'getLogin'          => 'GET/auth/getLogin',
    'login'             => 'POST/auth/checkLogin',
    'logout'            => 'POST/auth/logout',

    'getAddCompany'     => 'GET/companies/getAddCompany',
    'addCompany'        => 'POST/companies/addCompany',
    'removeCompany'     => 'POST/companies/removeCompany',
    'getUserCompanies'  => 'GET/companies/getUserCompanies',
    'getUpdateCompany'  => 'GET/companies/getUpdateCompany',
    'updateCompany'     => 'POST/companies/updateCompany'
];