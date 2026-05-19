<?php
    session_start();

    if (isset($_POST["action"]) && ($_POST["action"] == "logout")) {
        setcookie("login", $_COOKIE["login"], time() - 100000);
        setcookie("mdp", $_COOKIE["mdp"], time() - 100000);
        setcookie("langue", $_COOKIE["langue"], time() - 100000);
        session_destroy();
        header("Location: login.php");
        exit;
    }

    if (!isset($_SESSION["essais"])) {
        $_SESSION["essais"] = 0;
    }

    if (!isset($_SESSION["message"])) {
        $_SESSION["message"] = 0;
    }

    if (!isset($_SESSION["block"])) {
        $_SESSION["block"] = 0;
    }

    if (!isset($_SESSION["provenance"])) {
        $_SESSION["provenance"] = 0;
    }
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="style/index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<?php include("menu.php"); ?>
<body>
    
    
<br>

<form method="post" action="verif_connexion.php">
    <div class="grid-container3">
        <div class="co4 seco text_center">Connectez vous à OmnesEvent</div>
        <div class="co1">
            <input type="text" name="login" placeholder="Nom d'utilisateur">
        </div>
        <div class="co2">
            <input type="password" name="mdp" placeholder="Mot de passe">
        </div>
        <div class="co3">
            <input type="submit" value="Vérifier">
        </div>
        <div class="co5" id="sesouv"><input type="checkbox" id="souvenir" onchange="sesouvenir()">
<label for="souvenir">Se souvenir de moi</label></div>
        <div class="co0 text_center">
            <p>Vous n'avez pas de compte ?<a id="blue" href="inscription.php">inscrivez vous</a></p>
        </div>

    </div>
</form>
<script  src="jquery.js"></script>
    <script  src="menu.js"></script>
</body>
</html>
<?php
    if ($_SESSION["provenance"]) {
        if (!isset($_GET["correct"])) {
            $correct = 1;
        } else if (!$_GET["correct"] && ($_SESSION["message"] == 1) && ($_SESSION["block"] == 0)) {
            $_SESSION["essais"]++;
            echo "Login incorrect <br> Vous avez entré " . $_SESSION["essais"] . " mauvais identifiants";
        } else if (!$_GET["correct"] && ($_SESSION["message"] == 1) && ($_SESSION["block"] == 1)) {
            $_SESSION["essais"]++;
            echo "Login incorrect <br> Vous avez été bloqué pendant 5 secondes car vous avez entré " . $_SESSION["essais"] . " mauvais identifiants";
            sleep(5);
            $_SESSION["essais"] = 0;
            $_SESSION["message"] = 0;
            $_SESSION["block"] = 0;
        }
    }
?>