<?php include("connexion_BD.php"); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Événements</title>
    <link rel="stylesheet" href="Styles/index.css">
</head>
<body>

<?php include("menu.php"); ?>
<div style="padding-top:100px">
<main>
    <h1>Événements à venir</h1>

    <?php
        $req = $bdd->query("SELECT * FROM evenements");
        while($event = $req->fetch()) {
    ?>
        <?php include("det_ev.php"); ?>
    <?php } ?>

    <section id="detail" style="display:none;">
        <h2 id="detail-titre"></h2>
        <p id="detail-date"></p>
        <p id="detail-lieu"></p>
        <p id="detail-capacite"></p>
        <p id="detail-description"></p>
        <button id="btn-fermer">Fermer</button>
    </section>

</main>


<script src="Script/block_cascade.js"></script>

<script  src="jquery.js"></script>
    <script  src="menu.js"></script>
    </div>
</body>
</html>