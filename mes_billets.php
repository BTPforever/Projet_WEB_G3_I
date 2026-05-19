<?php include("connexion_BD.php"); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Billets</title>
    <link rel="stylesheet" href="style/index.css">
</head>
<body>

<?php include("menu.php"); ?>
<div style="padding-top:100px">
<main>
    <h1>Mes Billets</h1>

    <section id="billets">
        <?php
            if (isset($_POST["annulation"])){
                $requeteEvenAnnul = $bdd->prepare("DELETE FROM reservations WHERE (reservations.nomUtilUser = ? AND reservations.titreEven = ?)");
                $requeteEvenAnnul->execute(array($_COOKIE["nomUtil"], $_POST["titreEven"]));
            }    
            $requeteEven = $bdd->prepare("SELECT * FROM reservations INNER JOIN evenements ON reservations.titreEven = evenements.titre WHERE (reservations.nomUtilUser = ? AND evenements.evenDate >= CURDATE())");
            $requeteEven->execute(array($_COOKIE["nomUtil"]));
            $found = false;
            while ($reponseEven = $requeteEven->fetch()) {
                $found = true;
        ?>
        <form method="POST">
            <article>
                <h2><?php echo $reponseEven["titre"]; ?></h2>
                <p>Date : <?php echo $reponseEven["evenDate"]; ?></p>
                <p>Lieu : <?php echo $reponseEven["lieu"]; ?></p>

                <input type="hidden" name="titreEven" value="<?php echo $reponseEven["titre"]; ?>">

                <input type="submit" name="annulation" value="Annuler la réservation">
            </article>
        </form>
        <?php
            }
            if (!$found) echo "<p>Vous n'avez aucun billet à venir.</p>";
        ?>
    </section>
</main>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="script/index.js"></script>

</body>
</html>