<?php include("connexion_BD.php"); ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Événements</title>
    <link rel="stylesheet" href="style/index.css">
</head>
<body>

<?php include("menu.php"); ?>
<div class="ev">
<main>

<div style="padding-top:100px ">
    <h1 class="text_center" >Événements</h1>
    <div class="recherche-container">

        <input 
            type="text"
            id="recherche"
            placeholder="Rechercher un événement..."
        >

    </div>
    <div id="liste-evenements">

        <?php
            $req = $bdd->query("SELECT * FROM evenements");
            while($event = $req->fetch()) {
        ?>
            <div class="event-item">
                <?php include("det_ev.php"); ?>
            </div>
        <?php } ?>

    </div>
    <section id="detail" style="display:none;">
        <h2 id="detail-titre"></h2>
        <p id="detail-date"></p>
        <p id="detail-lieu"></p>
        <p id="detail-capacite"></p>
        <p id="detail-description"></p>
        <button id="btn-fermer">
            Fermer
        </button>

    </section>
</div>
</main>
<script src="jquery.js"></script>
<script src="menu.js"></script>
<script src="Script/block_cascade.js"></script>


</div>
</body>
</html>