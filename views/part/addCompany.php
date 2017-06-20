<form action="index.php" enctype="multipart/form-data"  method="post">
    <label for="name">Nom de l'entreprise</label>
    <input value="<?php if(isset($_SESSION['name'])) {echo $_SESSION['name'];}; ?>" type="text" id="name" name="name">

    <label for="type">Type d'entreprise</label>
    <select value="<?php if(isset($_SESSION['type'])) {echo $_SESSION['type'];}; ?>" name="type" id="type">
        <?php foreach ($data['types'] as $type) :?>
        <option value="<?= $type->typeId ?>"><?= $type->typeName ?></option>
        <?php endforeach; ?>
    </select>

    <label for="type">Localité</label>
    <select value="<?php if(isset($_SESSION['locality'])) {echo $_SESSION['locality'];}; ?>" name="locality" id="locality">
        <?php foreach ($data['localities'] as $locality) :?>
        <option value="<?= $locality->localityId ?>"><?= $locality->localityName ?></option>
        <?php endforeach; ?>
    </select>

    <label for="address">Adresse</label>
    <input value="<?php if(isset($_SESSION['address'])) {echo $_SESSION['address'];}; ?>" type="text" id="address" name="address">

    <label for="email">Adresse email</label>
    <input value="<?php if(isset($_SESSION['email'])) {echo $_SESSION['email'];}; ?>" type="email" id="email" name="email">

    <label for="phone">Numéro de téléphone</label>
    <input value="<?php if(isset($_SESSION['phone'])) {echo $_SESSION['phone'];}; ?>" type="text" id="phone" name="phone">

    <label for="img">Logo de l'entreprise</label>
    <input type="hidden" name="MAX_FILE_SIZE" value="3000000000">
    <input type="file" name="img">

    <label for="description">Description</label>
    <textarea name="description" id="description" cols="30" rows="10"><?php if(isset($_SESSION['description'])) {echo $_SESSION['description'];}; ?></textarea>

    <input type="hidden"
           name="a"
           value="addCompany">
    <input type="hidden"
           name="r"
           value="companies">

    <input type="submit" value="Ajouter l'entreprise">
</form>