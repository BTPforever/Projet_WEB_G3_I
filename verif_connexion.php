<?php
session_start();
include("connexion_BD.php");


if (isset($_POST["login"]) && isset($_POST["mdp"])) {
    $loginUser = htmlspecialchars($_POST["login"]);
    $mdpUser = htmlspecialchars($_POST["mdp"]);
    $reponseUser = $bdd->prepare("SELECT * FROM Users WHERE nomUtil = :loginUser");
    $reponseUser->execute(array("loginUser"=>$loginUser));
    $verifUser = $reponseUser->fetch();

    if ($verifUser && password_verify($mdpUser, $verifUser["mdp"]) && $verifUser["userValid"] == 1) {
        $_SESSION["essais"] = 0;
        $_SESSION["message"] = 0;
        $_SESSION["block"] = 0;
        setcookie("nomUtil", $verifUser["nomUtil"], time() + 3600);
        setcookie("userRole", $verifUser["userRole"], time() + 3600);
        setcookie("userValid", $verifUser["userValid"], time() + 3600);
        setcookie("nom", $verifUser["nom"], time() + 3600);
        setcookie("prenom", $verifUser["prenom"], time() + 3600);
        setcookie("id", $verifUser["id"], time() + 3600);
        header("Location: index.php");
        exit;
    } else if ($verifUser && password_verify($mdpUser, $verifUser["mdp"]) && $verifUser["userValid"] == 0) {
        setcookie("nomUtil", $verifUser["nomUtil"], time() + 3600);
        setcookie("userRole", $verifUser["userRole"], time() + 3600);
        setcookie("userValid", $verifUser["userValid"], time() + 3600);
        setcookie("nom", $verifUser["nom"], time() + 3600);
        setcookie("prenom", $verifUser["prenom"], time() + 3600);
        setcookie("id", $verifUser["id"], time() + 3600);
        header("Location: attente_validation.php");
        exit;
    } else {
        if (!isset($_SESSION["essais"])) $_SESSION["essais"] = 0;
        $_SESSION["essais"]++;
        if ($_SESSION["essais"] >= 3) {
            $_SESSION["block"] = 1;
        } else {
            $_SESSION["message"] = 1;
        }
        header("Location: connexion.php?correct=0");
        exit;
    }
}
?>