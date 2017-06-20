<form action="index.php" enctype="multipart/form-data"  method="post">
    <?php var_dump($data['types']); ?>
    <label for="name">Nom de l'entreprise</label>
    <input type="text" id="name" name="name">

    <label for="type">Type d'entreprise</label>
    <select name="type" id="type">
        <?php foreach ($data['types'] as $type) :?>
        <option value="<?= $type->typeId ?>"><?= $type->typeName ?></option>
        <?php endforeach; ?>
    </select>

    <label for="type">Localité</label>
    <select name="locality" id="locality">
        <?php foreach ($data['localities'] as $locality) :?>
        <option value="<?= $locality->localityId ?>"><?= $locality->localityName ?></option>
        <?php endforeach; ?>
    </select>

    <label for="address">Adresse</label>
    <input type="text" id="address" name="address">

    <label for="cover">Logo de l'entreprise</label>
    <input type="hidden" name="MAX_FILE_SIZE" value="3000000000">
    <input type="file" name="img">

    <label for="description">Description</label>
    <textarea name="description" id="description" cols="30" rows="10"></textarea>

    <input type="hidden"
           name="a"
           value="addCompany">
    <input type="hidden"
           name="r"
           value="companies">

    <input type="submit" value="Ajouter l'entreprise">
</form>