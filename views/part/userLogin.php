<form action="index.php" method="post">
    <label for="email">Votre adresse email</label>
    <input value="<?php if(isset($_SESSION['email'])) { echo $_SESSION['email'];}; ?>" type="email" id="email" name="email">

    <label for="password">Votre mot de passe</label>
    <input type="password" id="password" name="password">

    <input type="hidden"
           name="a"
           value="checkLogin">
    <input type="hidden"
           name="r"
           value="auth">
    <input type="submit" value="Se connecter">
</form>