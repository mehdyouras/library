<div>
    <p>Filtres</p>
    <form action="index.php" method="get">
        <label for="type">Type d'entreprise</label>
        <select name="type" id="type">
            <option value="all">Tout</option>
            <?php foreach ($data['types'] as $type) : ?>
                <option value="<?= $type->typeId ?>"><?= $type->typeName ?></option>
            <?php endforeach; ?>
        </select>

        <label for="locality">Localité de l'entreprise</label>
        <select name="locality" id="locality">
            <option value="all">Tout</option>
            <?php foreach ($data['localities'] as $locality) : ?>
                <option value="<?= $locality->localityId ?>"><?= $locality->localityName ?></option>
            <?php endforeach; ?>
        </select>

        <input type="hidden" name="a" value="indexBy">
        <input type="hidden" name="r" value="companies">
        <input type="submit" value="Filtrer">
    </form>
</div>
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
