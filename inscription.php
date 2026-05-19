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

<form method="post" action="inscription.php">
   <div class="grid-container4">
    <div class="seco text_center">Créer un compte OmnesEvent</div>
    <div class=" text_center">Vous avez déjà un compte OmnesEvent?<a id="blue" href=connexion.php>Connectez-vous</a></div>
    <input type="text" name="nom" placeholder="Nom">
    <input type="text" name="prenom" placeholder="Prénom">
    <input type="text" name="nomUtil" placeholder="Nom d'utilisateur">
    
    
        
    

    <input type="password" name="mdpOriginal" placeholder="Mot de passe">
    <input type="password" name="mdpConfirmation" placeholder="Confirmer le mot de passe">
    <label><input type="radio" name="userRole" value="P"> Participant</label>
        <label><input type="radio" name="userRole" value="O"> Organisateur</label>
        <label><input type="radio" name="userRole" value="A"> Administrateur</label>
    <input type="submit" value="S'inscrire">
    

</form>

<?php 
    if (isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["userRole"]) && isset($_POST["nomUtil"]) && isset($_POST["mdpOriginal"])) {
        if (($_POST["nom"] != "") && ($_POST["prenom"] != "") && ($_POST["nom"] != "") && ($_POST["nomUtil"] != "") && ($_POST["mdpOriginal"] != "")) {
            if ((strlen($_POST["nom"]) > 50) || (strlen($_POST["prenom"]) > 50)) {
                echo (strlen($_POST["nom"]) > 50) ? "Votre nom est trop long (maximum 50 caractères)" : "Votre prenom est trop long (maximum 50 caractères)";
            }
            else if (strlen($_POST["nomUtil"]) > 30) {
                echo "Nom d'utilisateur trop long (maximum 30 caractères)";
            }
            else if ((strlen($_POST["mdpOriginal"]) < 10) || (strlen($_POST["mdpOriginal"]) > 72)) {
                echo (strlen($_POST["mdpOriginal"]) < 10) ? "Le mot de passe choisi est trop court (minimum 10 caractères)" : "Le mot de passe choisi est trop long (maximum 72 caractères)";
            }
            else if ($_POST["mdpOriginal"] == $_POST["mdpConfirmation"]) {
                $requeteNomUtil = $bdd->prepare("SELECT * FROM Users WHERE nomUtil = ?");
                $requeteNomUtil->execute(array($_POST["nomUtil"]));
                if (!$requeteNomUtil->fetch()) {
                    $nomUtil = $_POST["nomUtil"];
                    $mdp = $_POST["mdpOriginal"];
                    $mdpHache = password_hash($mdp, PASSWORD_DEFAULT);
                    $nom = $_POST["nom"];
                    $prenom = $_POST["prenom"];
                    $userRole = $_POST["userRole"];
                    if ($userRole == "O") {
                        $userValid = 0;
                    }
                    else {
                        $userValid = 1;
                    }
                    $requete = $bdd->prepare("INSERT INTO Users (userRole, userValid, nomUtil, mdp, nom, prenom) VALUES (?, ?, ?, ?, ?, ?)");
                    $requete->execute(array($userRole, $userValid, $nomUtil, $mdpHache, $nom, $prenom));
                    header("Location: connexion.php?correct=0");
                    exit;
                }
                else {
                    echo "Le nom d'utilisateur choisi est déjà pris";
                }
            }
            else {
                echo "Veuillez vérifier la correspondance entre les mots de passe saisis";
            }
        }
        else {
            echo "L'une de vos saisies est vide";
        }
    }
    else {
        echo "Veuillez renseignez tous les champs";
    }
?>
</div>
<script  src="jquery.js"></script>
    <script  src="menu.js"></script>
    <script src="index.js"></script>
</body>

</html>