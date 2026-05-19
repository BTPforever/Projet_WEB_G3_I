<?php include("menu.php"); ?>
<br>
<br>

<?php
session_start();

echo "Bonjour " . $_COOKIE["prenom"] . " " . $_COOKIE["nom"] . ", votre compte est en attente de validation par un administrateur.";
?>