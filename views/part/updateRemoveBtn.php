<form action="index.php" method="post">
    <input type="hidden" name="a" value="removeCompany">
    <input type="hidden" name="r" value="companies">
    <input type="hidden" name="companyId" value="<?= $company->companyId; ?>">
    <input type="submit" value="Supprimer">
</form>
<form action="index.php#item<?= $company->companyId; ?>" method="get">
    <input type="hidden" name="a" value="getUpdateCompany">
    <input type="hidden" name="r" value="companies">
    <input type="hidden" name="updateId" value="<?= $company->companyId; ?>">
    <input type="submit" value="Modifier">
</form>