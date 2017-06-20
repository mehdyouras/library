<h3><?= $data['company']->companyName; ?></h3>
<p>
    <span><?= $data['company']->companyType; ?></span>
    <span><?= $data['company']->companyLocality; ?></span>
    <span><?= $data['company']->companyAddress; ?></span>
    <span><?= $data['company']->companyPhone; ?></span>
    <span><?= $data['company']->companyEmail; ?></span>
    <img src="<?= $data['company']->companyImg; ?>" alt="Logo de <?= $data['company']->companyName; ?>">
</p>
<p>
    <?php if(isset($data['company']) ) : ?>
    <?= $data['company']->companyDescription; ?>
    <?php else : ?>
        Aucune description.
    <?php endif; ?>
</p>
