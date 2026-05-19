 <!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Menu</title>
    <link rel="stylesheet" href="style/index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
  <header>
    <div id="burgerr"><button id="btn" class="burger">
                <span></span>
                <span></span>
                <span></span>
            </button></div>
<nav class="grid-container2 couleurbeige" id ="nav">
    
    
        <div class="nav0" ><a href="index.php"></p>Accueil</p></a></div>
        <div class="nav1"><a href="evenements.php"><p>Evenements</p></a></div>

        <?php if (isset($_COOKIE["userRole"]) && ($_COOKIE["userRole"] == "O" || $_COOKIE["userRole"] == "A")) { ?>
            <div class="nav2"><a href="creer_evenement.php"><p>Creer evenement</p></a></div>
        <?php } ?>

        <?php if (isset($_COOKIE["userRole"])) {
            if ($_COOKIE["userRole"] == "O") { ?>
                <div class="nav3"><a href="mes_evenements.php"><p>Mes evenements</p></a></div>
        <?php } 
        } ?>

        <?php if (!isset($_COOKIE["userRole"])) { ?>
            <div class="nav5"><a href="connexion.php"><p>Connexion</p></a></div>
        <?php } ?>

        <?php if (isset($_COOKIE["userRole"])) { ?>
            <div class="nav4"><a href="mon_profil.php"></p>Profil</p></a></div>
            <div class="nav8"><a href="mes_billets.php"><p>Billets</p></a></div>
            <div class="nav9"><a href="deconnexion.php"><p>Déconnexion</p></a></div>
        <?php } ?>
        <?php if (isset($_COOKIE["userRole"]) && $_COOKIE["userRole"] == "A") { ?>
            <div class="nav10"><a href="admin_comptes.php"><p>Gestion comptes</p></a></div>
        <?php } ?>
        
    
</nav>
    </header>
     <script type="text/javascript" src="script/Accueil.js"></script>
</body>