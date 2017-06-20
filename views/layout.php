<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bibliothèque d'entreprises</title>
</head>
<body>
    <header>
        <h1><a href="<?= SITE_URL ?>">Bibliothèque d'entreprises</a></h1>
        <nav>
            <?php if(!isset($_SESSION['user'])) : ?>
            <form action="index.php" method="get">
                <button type="submit">Se connecter</button>
                <input type="hidden"
                       name="a"
                       value="getLogin">
                <input type="hidden"
                       name="r"
                       value="auth">
            </form>
            <form action="index.php" method="get">
                <button type="submit">S'inscrire</button>
                <input type="hidden"
                    name="a"
                    value="getRegister">
                <input type="hidden"
                    name="r"
                    value="auth">
                </form>
            <?php endif; ?>

            <?php if(isset($_SESSION['user'])) : ?>
            <form action="index.php" method="post">
                <button type="submit">Se déconnecter</button>
                <input type="hidden"
                       name="a"
                       value="logout">
                <input type="hidden"
                       name="r"
                       value="auth">
            </form>
            <form action="index.php" method="get">
                <button type="submit">Ajouter une entreprise</button>
                <input type="hidden"
                       name="a"
                       value="getAddCompany">
                <input type="hidden"
                       name="r"
                       value="companies">
            </form>
            <form action="index.php" method="get">
                <button type="submit">Voir mes entreprises</button>
                <input type="hidden"
                       name="a"
                       value="getUserCompanies">
                <input type="hidden"
                       name="r"
                       value="companies">
            </form>

            <?php endif; ?>
        </nav>
    </header>
    <section class="wrapper">
        <h2>Contenu principal</h2>
        <?php include($data['view']);?>
    </section>
</body>
</html>