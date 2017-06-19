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
        <h1>Bibliothèque d'entreprises</h1>
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
            <?php endif; ?>
        </nav>
        <?php include($data['view']);?>
    </header>
</body>
</html>