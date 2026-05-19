<?php include("connexion_BD.php"); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Billets</title>
    <link rel="stylesheet" href="Styles/index.css">
</head>
<body>

<?php include("menu.php"); ?>
<div style="padding-top:100px">
<main>
    <h1>Mes Billets</h1>

    <section id="billets">
        <?php
            $requeteEven = $bdd->prepare("SELECT * FROM reservations INNER JOIN evenements ON reservations.titreEven = evenements.id WHERE reservations.nomUtilUser = ? AND evenements.evenDate >= CURDATE()");
            $requeteEven->execute(array($_COOKIE["id"]));
            $found = false;
            while ($reponseEven = $requeteEven->fetch()) {
                $found = true;
        ?>
            <article>
                <h2><?php echo $reponseEven["titre"]; ?></h2>
                <p>Date : <?php echo $reponseEven["evenDate"]; ?></p>
                <p>Lieu : <?php echo $reponseEven["lieu"]; ?></p>
            </article>
        <?php
            }
            if (!$found) echo "<p>Vous n'avez aucun billet à venir.</p>";
        ?>
    </section>
</main>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="Script/index.js"></script>
 <script  src="jquery.js"></script>
    <script  src="menu.js"></script>
</body>
</html>