
<ul>
    <?php foreach ($data['companies'] as $company) :  ?>
        <?php if(isset($_GET['updateId'])) : ?>
            <?php if($company->companyId === $_GET['updateId']) : ?>
                <?php include 'views/part/updateCompany.php'; ?>
            <?php else : ?>
                <?php include 'views/part/companyItem.php'; ?>
            <?php endif; ?>
        <?php else : ?>
            <?php include 'views/part/companyItem.php'; ?>
        <?php endif; ?>
    <?php endforeach; ?>
</ul>
