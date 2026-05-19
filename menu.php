
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Billets</title>
    <link rel="stylesheet" href="style/index.css">
</head>
<body>
<header>
    <div id="burgerr"><button type="button" id="btn" class="burger">
                <span></span>
                <span></span>
                <span></span>
            </button></div>
    <div id="mondiv">
        <div class="nav0"><a href="index.php"><p class="blanc">Accueil</p></a></div>
        <div class="nav1"><a href="evenements.php"><p class="blanc">Evenements</p></a></div>

        <?php if (isset($_COOKIE["userRole"]) && ($_COOKIE["userRole"] == "O" || $_COOKIE["userRole"] == "A")) { ?>
            <div class="nav2"><a href="creer_evenement.php"><p class="blanc">Creer evenement</p></a></div>
        <?php } ?>

        <?php if (isset($_COOKIE["userRole"])) { ?>
            <div class="nav3"><a href="mes_evenements.php"><p class="blanc">Mes evenements</p></a></div>
            <div class="nav4"><a href="mon_profil.php"><p class="blanc">Profil</p></a></div>
        <?php } ?>

        <?php if (!isset($_COOKIE["userRole"])) { ?>
            <div class="nav5"><a href="connexion.php"><p class="blanc">Connexion</p></a></div>
        <?php } ?>

        <div id="sous-menu">
            <?php if (isset($_COOKIE["userRole"])) { ?>
                <div class="nav8"><a href="mes_billets.php"><p class="blanc">Billets</p></a></div>
            <?php } ?>
            <?php if (isset($_COOKIE["userRole"]) && $_COOKIE["userRole"] == "A") { ?>
                <a href="admin_comptes.php"><p class="blanc">Gestion comptes</p></a>
            <?php } ?>
        </div>
    </div>

    <nav class="grid-container2 couleurbeige" id="nav">
        <div class="nav0"><a href="index.php"><p class="blanc">Accueil</p></a></div>
        <div class="nav1"><a href="evenements.php"><p class="blanc">Evenements</p></a></div>

        <?php if (isset($_COOKIE["userRole"]) && ($_COOKIE["userRole"] == "O" || $_COOKIE["userRole"] == "A")) { ?>
            <div class="nav2"><a href="creer_evenement.php"><p class="blanc">Creer evenement</p></a></div>
        <?php } ?>

        <?php if (isset($_COOKIE["userRole"])) { ?>
            <div class="nav3"><a href="mes_evenements.php"><p class="blanc">Mes evenements</p></a></div>
            <div class="nav4"><a href="mon_profil.php"><p class="blanc">Profil</p></a></div>
        <?php } ?>

        <?php if (!isset($_COOKIE["userRole"])) { ?>
            <div class="nav5"><a href="connexion.php"><p class="blanc">Connexion</p></a></div>
        <?php } ?>

        <div id="sous-menu">
            <?php if (isset($_COOKIE["userRole"])) { ?>
                <div class="nav8"><a href="mes_billets.php"><p class="blanc">Billets</p></a></div>
            <?php } ?>
            <?php if (isset($_COOKIE["userRole"]) && $_COOKIE["userRole"] == "A") { ?>
                <a href="admin_comptes.php"><p class="blanc">Gestion comptes</p></a>
            <?php } ?>
        </div>
    </nav>
</header>
</body>
</html>

