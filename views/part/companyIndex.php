
<ul>
    <?php var_dump($data['companies']); foreach ($data['companies'] as $company) :  ?>
        <li>
            <p><?= $company->companyName; ?></p>
            <p><?= $company->companyType; ?></p>
            <p><?= $company->companyLocality; ?></p>
            <p><?= $company->companyAddress; ?></p>
            <img width="300px" src="<?= $company->companyImg ?>" alt="tets">
        </li>
    <?php endforeach; ?>
</ul>
