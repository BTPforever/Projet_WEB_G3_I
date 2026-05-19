<?php include("connexion_BD.php"); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes événements</title>
    <link rel="stylesheet" href="style/index.css">
</head>
<body>

<?php include("menu.php"); ?>
<br>
<br>
<div style="padding-top:100px">
<?php
    echo "Bienvenue sur le page de gesiton de vos événements " . $_COOKIE["prenom"] . " " . $_COOKIE["nom"] . " !<br>";
    echo "<br>";
    echo "Vous êtes connecté en tant que : " . $_COOKIE["nomUtil"] . "<br>";

    // $requeteEvenPass = $bdd->prepare("SELECT * FROM Reservations INNER JOIN Evenements ON Reservations.titreEven = Evenements.titre WHERE (nomUtilCrea = ? AND evenDate < CURDATE())");
    $requeteEvenPass = $bdd->prepare("SELECT * FROM Evenements WHERE (nomUtilCrea = ? AND evenDate >= CURDATE())");
    $requeteEvenPass->execute(array($_COOKIE["nomUtil"]));
    if ($reponseEvenPass = $requeteEvenPass->fetch()) {
        $requeteParticipantsPass = $bdd->prepare("SELECT nomUtilUser FROM Reservations WHERE titreEven = ?");
        $requeteParticipantsPass->execute(array($reponseEvenPass["titre"]));
        echo "Voici les événements passés que vous avez créés : <br>";
        echo "Evénement " . $reponseEvenPass["titre"] . " qui a eu lieu le " . $reponseEvenPass["evenDate"] . " au " . $reponseEvenPass["lieu"] . "<br>";
        echo "Les participants à cet événement étaient : <br>";
        while ($reponseParticipantsPass = $requeteParticipantsPass->fetch()) {
            echo $reponseParticipantsPass["nomUtilUser"] . "<br>";
        }
    }
    else {
        echo "Vous n'avez créé aucun événement passé. <br>";
    }
    while ($reponseEvenPass = $requeteEvenPass->fetch()) {
        $requeteParticipantsPass = $bdd->prepare("SELECT nomUtilUser FROM Reservations WHERE titreEven = ?");
        $requeteParticipantsPass->execute(array($reponseEvenPass["titre"]));
        echo "Evénement " . $reponseEvenPass["titre"] . " qui a eu lieu le " . $reponseEvenPass["evenDate"] . " au " . $reponseEvenPass["lieu"] . "<br>";
        echo "Les participants à cet événement étaient : <br>";
        while ($reponseParticipantsPass = $requeteParticipantsPass->fetch()) {
            echo $reponseParticipantsPass["nomUtilUser"] . "<br>";
        }
    }
    echo "<br> <br>";
    $requeteEvenFut = $bdd->prepare("SELECT * FROM Evenements WHERE (nomUtilCrea = ? AND evenDate >= CURDATE())");
    $requeteEvenFut->execute(array($_COOKIE["nomUtil"]));
    if ($reponseEvenFut = $requeteEvenFut->fetch()) {
        $requeteParticipantsFut = $bdd->prepare("SELECT nomUtilUser FROM Reservations WHERE titreEven = ?");
        $requeteParticipantsFut->execute(array($reponseEvenFut["titre"]));
        echo "Voici les événements à venir que vous avez créés : <br>";
        echo "Evénement " . $reponseEvenFut["titre"] . " qui aura lieu le " . $reponseEvenFut["evenDate"] . " au " . $reponseEvenFut["lieu"] . "<br>";
        echo "Les participants à cet événement sont : <br>";
        while ($reponseParticipantsFut = $requeteParticipantsFut->fetch()) {
            echo $reponseParticipantsFut["nomUtilUser"] . "<br>";
        }
    }
    else {
        echo "Vous n'avez créé aucun événement à venir. <br>";
    }
    while ($reponseEvenFut = $requeteEvenFut->fetch()) {
        $requeteParticipantsFut = $bdd->prepare("SELECT nomUtilUser FROM Reservations WHERE titreEven = ?");
        $requeteParticipantsFut->execute(array($reponseEvenFut["titre"]));
        echo "Evénement " . $reponseEvenFut["titre"] . " qui aura lieu le " . $reponseEvenFut["evenDate"] . " au " . $reponseEvenFut["lieu"] . "<br>";
        echo "Les participants à cet événement sont : <br>";
        while ($reponseParticipantsFut = $requeteParticipantsFut->fetch()) {
            echo $reponseParticipantsFut["nomUtilUser"] . "<br>";
        }
    }
?>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="Script/index.js"></script>
<script  src="jquery.js"></script>
    <script  src="menu.js"></script>
</body>
</html>