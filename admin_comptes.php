<?php include("connexion_BD.php"); ?>

<?php include("menu.php"); ?>
<br>
<br>

<?php
    echo "Bienvenue sur le page de validation des comptes en attente " . $_COOKIE["prenom"] . " " . $_COOKIE["nom"] . " !<br> <br> <br>";

    if (isset($_GET["nomUtil"])) {
        $requeteValid = $bdd->prepare("UPDATE Users SET userValid = 1 WHERE (nomUtil = ? AND userRole = 'O')");
        $requeteValid->execute(array($_GET["nomUtil"]));
        header("Location: admin_comptes.php");
        exit;
    }
    else {
        $requeteValid = $bdd->prepare("SELECT * FROM Users WHERE (userValid = 0 AND userRole = 'O')");
        $requeteValid->execute();
        if ($reponseValid = $requeteValid->fetch()) {
            echo "Voici les comptes d'organisateurs en attente de validation :<br>";
            echo $reponseValid["nomUtil"] . "<a href='admin_comptes.php?nomUtil=" . $reponseValid["nomUtil"] . "'>Valider cet organisateur</a><br>";
        }
        else {
            echo "Il n'y a aucun compte d'organisateur en attente de validation. <br>";
        }
        while ($reponseValid = $requeteValid->fetch()) {
            echo $reponseValid["nomUtil"] . "<a href='admin_comptes.php?nomUtil=" . $reponseValid["nomUtil"] . "'>Valider cet organisateur</a><br>";
        }
    }

    echo "Voici l'ensemble des comptes créés sur la plateforme :<br> <br> <br>";

    $requeteComptes = $bdd->prepare("SELECT * FROM Users");
    $requeteComptes->execute();

    while ($reponseComptes = $requeteComptes->fetch()) {
        echo "Nom d'utilisateur : " . $reponseComptes["nomUtil"] . "<br>";
        echo "Prénom : " . $reponseComptes["prenom"] . "<br>";
        echo "Nom : " . $reponseComptes["nom"] . "<br>";
        echo "Rôle : " . $reponseComptes["userRole"] . "<br>";
        if ($reponseComptes["userRole"] == "O") {
            echo "Validé : " . ($reponseComptes["userValid"] ? "Oui" : "Non") . "<br>";
        }
        echo "<br>";
        echo "<a href='admin_comptes.php?nomUtil=" . $reponseComptes["nomUtil"] . "&amp;suppressionCompte=1'>Supprimer ce compte</a><br><br>";
        echo "<br>";
    }

    echo "Voici l'ensemble des événements créés sur la plateforme :<br> <br> <br>";

    $requeteEvenements = $bdd->prepare("SELECT * FROM Evenements");
    $requeteEvenements->execute();

    while ($reponseEvenements = $requeteEvenements->fetch()) {
        echo "Nom de l'événement : " . $reponseEvenements["titre"] . "<br>";
        echo "Date de l'événement : " . $reponseEvenements["evenDate"] . "<br>";
        echo "Lieu de l'événement : " . $reponseEvenements["lieu"] . "<br>";
        echo "Créé par : " . $reponseEvenements["nomUtilCrea"] . "<br>";
        echo "<br>";
        echo "<a href='admin_comptes.php?titreEven=" . $reponseEvenements["titre"] . "&amp;suppressionEvenement=1'>Supprimer cet événement</a><br><br>";
        echo "<br>";
    }
?>