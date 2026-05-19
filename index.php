<?php include("connexion_BD.php"); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="style/index.css">
</head>
<body>

<?php include("menu.php"); ?>
 <div class="grid-container" >
    
<main class="grid-item2">
    <h1>Liste des événements</h1>
    <h2>Événements à venir</h2>

    <?php
        if (isset($_POST["inscription"])){
            $requeteVerif = $bdd->prepare("SELECT * FROM Reservations WHERE (nomUtilUser = ? AND titreEven = ?)");
            $requeteVerif->execute(array($_COOKIE["nomUtil"], $_POST["titreEven"]));
            if (!($reponseVerif = $requeteVerif->fetch())) {
                $requeteInscri = $bdd->prepare("INSERT INTO Reservations (nomUtilUser, titreEven) VALUES (?, ?)");
                $requeteInscri->execute(array($_COOKIE["nomUtil"], $_POST["titreEven"]));
            }
        }    
        $requeteEven = $bdd->prepare("SELECT e.*, COUNT(r.titreEven) AS nbReservations FROM evenements e LEFT JOIN reservations r ON e.titre = r.titreEven WHERE e.evenDate >= CURDATE() GROUP BY e.titre");
        $requeteEven->execute();
        $found = false;
        while ($reponseEven = $requeteEven->fetch()) {
            $found = true;
            $placesRestantes = $reponseEven["capacite"] - $reponseEven["nbReservations"];
    ?>
        <form method="POST">
            <article>
                <h3><?php echo $reponseEven["titre"]; ?></h3>
                <p><?php echo $reponseEven["evenDate"]; ?></p>
                <p><?php echo $reponseEven["lieu"]; ?></p>
                <p><?php echo $placesRestantes; ?> places restantes</p>
                <img src="<?php echo 'images/' . $reponseEven["affiche"]; ?>" height='200'>

                <input type="hidden" name="titreEven" value="<?php echo $reponseEven["titre"]; ?>">

                <input type="submit" name="inscription" value="Réserver une place">
            </article>
        </form>
    <?php
        }
        if (!$found) echo "<p>Aucun événement à venir.</p>";
    ?>
</main>

<?php include("footer.php"); ?>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="script/index.js"></script>
</div>
</body>

</html>
