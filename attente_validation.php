<?php include("menu.php"); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil</title>
    <link rel="stylesheet" href="style/index.css">
</head>
<body>
<br>
<br>

<?php
session_start();

echo "Bonjour " . $_COOKIE["prenom"] . " " . $_COOKIE["nom"] . ", votre compte est en attente de validation par un administrateur.";
?>

 <script  src="jquery.js"></script>
    <script  src="menu.js"></script>
</body>
</html>
