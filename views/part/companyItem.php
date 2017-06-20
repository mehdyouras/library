<li>
    <p><?= $company->companyName; ?></p>
    <p><?= $company->companyType; ?></p>
    <p><?= $company->companyLocality; ?></p>
    <p><?= $company->companyAddress; ?></p>
    <img width="300px" src="<?= $company->companyImg ?>" alt="tets">
    <?php if(isset($_GET['a'])) : ?>
        <?php if($_GET['a'] === 'getUserCompanies') :?>
            <?php include 'views/part/updateRemoveBtn.php';?>
        <?php endif; ?>
    <?php endif; ?>
</li>