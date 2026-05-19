<?php include("menu.php"); ?>
<br>
<br>

<?php
include("connexion_BD.php");
    if ($_COOKIE["userRole"] == "P") {
        if (isset($_GET["titreEven"]) && !isset($_GET["reservation"])) {
            $titreEven = $_GET["titreEven"];
            $requeteEven = $bdd->prepare("SELECT * FROM Evenements WHERE titre = ?");
            $requeteEven->execute(array($titreEven));
            $requeteReser = $bdd->prepare("SELECT * FROM Reservations INNER JOIN Evenements ON Reservations.titreEven = Evenements.titre WHERE (nomUtilUser = ? AND titreEven >= ?)");
            $requeteReser->execute(array($_COOKIE["nomUtil"], $titreEven));
            if ($reponseEven = $requeteEven->fetch()) {
                echo "Titre : " . $reponseEven["titre"] . "<br>";
                echo "Date : " . $reponseEven["evenDate"] . "<br>";
                echo "Lieu : " . $reponseEven["lieu"] . "<br>";
                echo "Capacité : " . $reponseEven["capacite"] . "<br>";
                echo "Description : " . $reponseEven["evenDescription"] . "<br> <br>";
                if (!$requeteReser->fetch()) {
                    echo "Vous n'avez pas encore réservé votre place à cet événement. <br> <br>";
                    echo "<a href='detail_evenement.php?titreEven=" . $_GET["titreEven"] . "&amp;reservation=1'>Cliquez ici pour réserver votre place à cet événement</a><br><br>";
                } 
                else {
                    echo "Vous avez déjà réservé votre place à cet événement. <br> <br>";
                    echo "<a href='detail_evenement.php?titreEven=" . $_GET["titreEven"] . "&amp;reservation=2'>Cliquez ici pour annuler votre réservation à cet événement</a><br><br>";
                }
            } 
            else {
                echo "Aucun événement trouvé avec ce titre. <br>";
            }
        } 
        else if (isset($_aGET["titreEven"]) && isset($_GET["reservation"])) {
            if ($_GET["reservation"] == "1") {
                $requeteInscription = $bdd->prepare("INSERT INTO Reservations (nomUtilUser, titreEven) VALUES (?, ?)");
                $requeteInscription->execute(array($_COOKIE["nomUtil"], $_GET["titreEven"]));
                header("Location: index.php");
                exit;
            } 
            else if ($_GET["reservation"] == "2") {
                $requeteAnnulation = $bdd->prepare("DELETE FROM Reservations WHERE (nomUtilUser = ? AND titreEven = ?)");
                $requeteAnnulation->execute(array($_COOKIE["nomUtil"], $_GET["titreEven"]));
                header("Location: index.php");
                exit;
            }
        } 
        else {
            echo "Aucun titre d'événement spécifié. <br>";
        }

    } 
    else if ($_COOKIE["userRole"] == "O") {

    } 
    else if ($_COOKIE["userRole"] == "A") {

    }
?>