<?php include("connexion_BD.php"); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="Styles/index.css">
</head>
<body>

<?php include("menu.php"); ?>

 <div class="grid-container" >
    
<main class="grid-item2">
    <h1 id="logo" class="text_center">Omnesevent</h1>
    <h2 id="t">Trouver votre prochain évenement !</h2>
    <div class="listescroll">
    <?php
        $requeteEven = $bdd->prepare("SELECT e.*, COUNT(r.titreEven) AS nbReservations FROM evenements e LEFT JOIN reservations r ON e.id = r.titreEven WHERE e.evenDate >= CURDATE() GROUP BY e.id");
        $requeteEven->execute();
        $found = false;
        while ($reponseEven = $requeteEven->fetch()) {
            $found = true;
            $placesRestantes = $reponseEven["capacite"] - $reponseEven["nbReservations"];
    ?>
        <article id="liste">
            <h3><?php echo $reponseEven["titre"]; ?></h3>
            <p><?php echo $reponseEven["evenDate"]; ?></p>
            <p><?php echo $reponseEven["lieu"]; ?></p>
            <p><?php echo $placesRestantes; ?> places restantes</p>
            
            <?php if (isset($_COOKIE["userRole"])) {
                if($_COOKIE["userRole"] == "P") { ?>
                    <button>S'inscrire</button>
            <?php } 
            }?>
        </article>
    <?php
        }
        if (!$found) echo "<p>Aucun événement à venir.</p>";
    ?>
       </div>
</main>

<?php include("footer.php"); ?>

</div>
 <script  src="jquery.js"></script>
    <script  src="menu.js"></script>

</body>

</html>
