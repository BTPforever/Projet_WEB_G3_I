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

<form method="post" action="creer_evenement.php" enctype="multipart/form-data">
    <div class="grid-container5">
        <div class="seco text_center">Créer votre événement</div>
     <input type="text" name="titre" placeholder="Titre de l'évènement">
    <input type="text" name="evenDescription" placeholder="Description de l'évènement">
    <input type="text" name="lieu" placeholder="Adresse de l'évènement">
    <input type="date" name="evenDate" placeholder="Date de l'évènement">
   <input type="file" name="image" accept="image/*" id="image" style="display:none">
   <input type="number" name="capacite" placeholder="Capacité de l'évènement">
<label for="image" id="faux-bouton">📁 Choisir une image</label>
    <input type="submit" value="Créer l'évènement" id="creer">
    
</form>

<?php 
    function validerDate($date, $format = 'Y-m-d') {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }

    if (isset($_POST["titre"]) && isset($_POST["evenDescription"]) && isset($_POST["evenDate"]) && isset($_POST["lieu"]) && isset($_FILES["image"]) && isset($_POST["capacite"])) {
        $imageRecue = ($_FILES["image"]["error"] === 0);
        if (($_POST["titre"] != "") && ($_POST["evenDescription"] != "") && ($_POST["evenDate"] != "") && ($_POST["lieu"] != "") && $imageRecue && ($_POST["capacite"] != "")) {
            if ((strlen($_POST["titre"]) > 50) || (strlen($_POST["evenDescription"]) > 255)) {
                echo (strlen($_POST["titre"]) > 50) ? "Le titre de l'évènement est trop long (maximum 50 caractères)" : "La description de l'évènement est trop longue (maximum 255 caractères)";
            }
            else if (strlen($_POST["lieu"]) > 50) {
                echo "L'adresse de l'évènement est trop longue (maximum 50 caractères)";
            }
            else if ((strlen($_POST["capacite"]) < 1) || (strlen($_POST["capacite"]) > 10000)) {
                echo (strlen($_POST["capacite"]) < 1) ? "La capacité de l'évènement est invalide" : "La capacité de l'évènement est trop élevée (maximum 10 000 participants)";
            }
            $aujourdhui = date("Y-m-d");
            if (!validerDate($_POST["evenDate"])) {
                echo "Erreur : La date est invalide ou mal formatée.";
            }
            else if ($_POST["evenDate"] < $aujourdhui) {
                echo "La date de l'évènement est invalide";
            }
            else {
                $requeteEven = $bdd->prepare("SELECT * FROM Evenements WHERE titre = ?");
                $requeteEven->execute(array($_POST["titre"]));
                if (!$requeteEven->fetch()) {
                    $dossierDestination = "images/";
                    $nomOrigine = $_FILES["image"]["name"];

                    $extension = pathinfo($nomOrigine, PATHINFO_EXTENSION);
                    
                    $nomUniqueImage = "affiche_" . uniqid() . "." . $extension;
                    $cheminComplet = $dossierDestination . $nomUniqueImage;

                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $cheminComplet)) {
                        $requete = $bdd->prepare("INSERT INTO Evenements (titre, evenDescription, evenDate, lieu, affiche, capacite, nomUtilCrea) VALUES (?, ?, ?, ?, ?, ?, ?)");
                        $requete->execute(array($_POST["titre"], $_POST["evenDescription"], $_POST["evenDate"], $_POST["lieu"], $nomUniqueImage, $_POST["capacite"], $_COOKIE["nomUtil"]));
                        
                        header("Location: index.php?correct=0");
                        exit;
                    } else {
                        echo "Une erreur est survenue lors du transfert de l'image.";
                    }
                }
                else {
                    echo "Un évènement portant ce titre existe déjà, veuillez en choisir un autre";
                }
            }
        }
        else {
            echo "L'une de vos saisies est vide ou l'image est manquante";
        }
    }
    else {
        echo "Veuillez renseignez tous les champs";
    }
?>
</div>
<script  src="jquery.js"></script>
    <script  src="menu.js"></script>
</body>

</html>