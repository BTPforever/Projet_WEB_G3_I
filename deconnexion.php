<?php
    session_start();

    $cookies = ["nomUtil", "userRole", "userValid", "login", "mdp", "nom", "prenom", "id"];
    foreach ($cookies as $cookie) {
        setcookie($cookie, "", time() - 10000);
    }

    session_destroy();
    header("Location: index.php");
    exit;
?>