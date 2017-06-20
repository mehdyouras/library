    <li>
        <form action="index.php" method="post">
            <label for="name">Nom de l'entreprise</label>
            <input type="text" id="name" name="name" value="<?= $company->companyName ?>">

            <label for="type">Type d'entreprise</label>
            <select value="<?= $company->companyTypeId ?>" name="type" id="type">
                <?php foreach ($data['types'] as $type) :?>
                    <option value="<?= $type->typeId ?>"><?= $type->typeName ?></option>
                <?php endforeach; ?>
            </select>

            <label for="type">Localité</label>
            <select value="<?= $company->companyLocalityId ?>" name="locality" id="locality">
                <?php foreach ($data['localities'] as $locality) :?>
                    <option value="<?= $locality->localityId ?>"><?= $locality->localityName ?></option>
                <?php endforeach; ?>
            </select>

            <label for="address">Adresse</label>
            <input value="<?= $company->companyAddress ?>" type="text" id="address" name="address">

            <label for="cover">Logo de l'entreprise</label>
            <img src="<?= $company->companyImg ?>" alt="Logo de l'entreprise">
            <input type="hidden" name="MAX_FILE_SIZE" value="3000000000">
            <input type="file" name="img">

            <label for="description">Description</label>
            <textarea name="description" id="description" cols="30" rows="10"><?= $company->companyDescription; ?></textarea>

            <input type="hidden" name="a" value="updateCompany">
            <input type="hidden" name="r" value="companies">
            <input type="hidden" name="updateId" value="<?= $company->companyId; ?>">
            <input type="submit" value="Modifier">
        </form>
    </li>