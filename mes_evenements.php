<?php include("connexion_BD.php"); ?>

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
        $requeteParticipantsPass->execute(array($reponseEvenPass["titreEven"]));
        echo "Voici les événements passés que vous avez créés : <br>";
        echo "Evénement " . $reponseEvenPass["titreEven"] . " qui a eu lieu le " . $reponseEvenPass["evenDate"] . " au " . $reponseEvenPass["lieu"] . "<br>";
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
        $requeteParticipantsPass->execute(array($reponseEvenPass["titreEven"]));
        echo "Evénement " . $reponseEvenPass["titreEven"] . " qui a eu lieu le " . $reponseEvenPass["evenDate"] . " au " . $reponseEvenPass["lieu"] . "<br>";
        echo "Les participants à cet événement étaient : <br>";
        while ($reponseParticipantsPass = $requeteParticipantsPass->fetch()) {
            echo $reponseParticipantsPass["nomUtilUser"] . "<br>";
        }
    }
    $requeteEvenFut = $bdd->prepare("SELECT * FROM Evenements WHERE (nomUtilCrea = ? AND evenDate >= CURDATE())");
    $requeteEvenFut->execute(array($_COOKIE["nomUtil"]));
    if ($reponseEvenFut = $requeteEvenFut->fetch()) {
        $requeteParticipantsFut = $bdd->prepare("SELECT nomUtilUser FROM Reservations WHERE titreEven = ?");
        $requeteParticipantsFut->execute(array($reponseEvenFut["titreEven"]));
        echo "Voici les événements à venir que vous avez créés : <br>";
        echo "Evénement " . $reponseEvenFut["titreEven"] . " qui aura lieu le " . $reponseEvenFut["evenDate"] . " au " . $reponseEvenFut["lieu"] . "<br>";
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
        $requeteParticipantsFut->execute(array($reponseEvenFut["titreEven"]));
        echo "Evénement " . $reponseEvenFut["titreEven"] . " qui aura lieu le " . $reponseEvenFut["evenDate"] . " au " . $reponseEvenFut["lieu"] . "<br>";
        echo "Les participants à cet événement sont : <br>";
        while ($reponseParticipantsFut = $requeteParticipantsFut->fetch()) {
            echo $reponseParticipantsFut["nomUtilUser"] . "<br>";
        }
    }
?>
</div>