<form action="index.php" method="post">
    <label for="email">Votre adresse email</label>
    <input type="email" id="email" name="email">

    <label for="password">Votre mot de passe</label>
    <input type="password" id="password" name="password">

    <label for="passwordCheck">Entrez à nouveau votre mot de passe</label>
    <input type="password" id="passwordCheck" name="passwordCheck">

    <input type="hidden" value="register" name="a">
    <input type="hidden" value="auth" name="r">
    <input type="submit" value="S'inscrire">
</form>