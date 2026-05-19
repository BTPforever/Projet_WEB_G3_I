<?php 
include("connexion_BD.php");

if (isset($_POST["prenom"]) && isset($_POST["nom"])) {
    $prenom = htmlspecialchars($_POST["prenom"]);
    $nom = htmlspecialchars($_POST["nom"]);
    
    $req = $bdd->prepare("UPDATE Users SET prenom = ?, nom = ? WHERE nomUtil = ?");
    $req->execute(array($prenom, $nom, $_COOKIE["nomUtil"]));
    
    setcookie("prenom", $prenom, time() + 3600);
    setcookie("nom", $nom, time() + 3600);

    if (!empty($_POST["mdp"])) {
        $mdp = password_hash($_POST["mdp"], PASSWORD_DEFAULT);
        $req2 = $bdd->prepare("UPDATE Users SET mdp = ? WHERE nomUtil = ?");
        $req2->execute(array($mdp, $_COOKIE["nomUtil"]));
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil</title>
    <link rel="stylesheet" href="Styles/index.css">
</head>
<body>

<?php include("menu.php"); ?>
<div id="profil">
<main>
    <h1>Bonjour <?php echo isset($_COOKIE["prenom"]) ? $_COOKIE["prenom"] . " " . $_COOKIE["nom"] : ""; ?> !</h1>

    <section id="infos">
        <h2>Informations personnelles</h2>
        <p>Nom d'utilisateur : <?php echo isset($_COOKIE["nomUtil"]) ? $_COOKIE["nomUtil"] : ""; ?></p>
        <p>Rôle :
            <?php
                if (isset($_COOKIE["userRole"])) {
                    if ($_COOKIE["userRole"] == "P") echo "Participant";
                    else if ($_COOKIE["userRole"] == "O") echo "Organisateur";
                    else if ($_COOKIE["userRole"] == "A") echo "Administrateur";
                }
            ?>
        </p>
        <?php if (isset($_COOKIE["userRole"]) && $_COOKIE["userRole"] == "O") { ?>
            <p>Statut : <?php echo ($_COOKIE["userValid"] == 1) ? "Validé" : "En attente de validation"; ?></p>
        <?php } ?>
    </section>

    <section id="modifier-profil">
        <h2>Modifier mon profil</h2>
        <form method="post">
            <label>Prénom</label>
            <input type="text" name="prenom" value="<?php echo isset($_COOKIE['prenom']) ? $_COOKIE['prenom'] : ''; ?>">

            <label>Nom</label>
            <input type="text" name="nom" value="<?php echo isset($_COOKIE['nom']) ? $_COOKIE['nom'] : ''; ?>">

            <label>Nouveau mot de passe</label>
            <input type="password" name="mdp" placeholder="Laisser vide pour ne pas changer">

            <button type="submit">Enregistrer</button>
        </form>
    </section>

    <section id="reservations-passees">
        <h2>Réservations passées</h2>
        <?php
            $requeteEvenPass = $bdd->prepare("SELECT * FROM reservations INNER JOIN evenements ON reservations.titreEven = evenements.id WHERE reservations.titreEven = ? AND evenements.evenDate < CURDATE()");
            $requeteEvenPass->execute(array($_COOKIE["id"]));
            $found = false;
            while ($reponseEven = $requeteEvenPass->fetch()) {
                $found = true;
        ?>
            <article>
                <h3><?php echo $reponseEven["titre"]; ?></h3>
                <p>Date : <?php echo $reponseEven["evenDate"]; ?></p>
                <p>Lieu : <?php echo $reponseEven["lieu"]; ?></p>
            </article>
        <?php
            }
            if (!$found) echo "<p>Vous n'avez aucune réservation passée.</p>";
        ?>
    </section>

    <section id="reservations-avenir">
        <h2>Réservations à venir</h2>
        <?php
            $requeteEvenFut = $bdd->prepare("SELECT * FROM reservations INNER JOIN evenements ON reservations.titreEven = evenements.id WHERE reservations.nomUtilUser = ? AND evenements.evenDate >= CURDATE()");
            $requeteEvenFut->execute(array($_COOKIE["id"]));
            $found = false;
            while ($reponseEven = $requeteEvenFut->fetch()) {
                $found = true;
        ?>
            <article>
                <h3><?php echo $reponseEven["titre"]; ?></h3>
                <p>Date : <?php echo $reponseEven["evenDate"]; ?></p>
                <p>Lieu : <?php echo $reponseEven["lieu"]; ?></p>
            </article>
        <?php
            }
            if (!$found) echo "<p>Vous n'avez aucune réservation à venir.</p>";
        ?>
        <a href="deconnexion.php"><button>se deco</button></a>
    </section>
</main>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="Script/index.js"></script>
<script  src="jquery.js"></script>
    <script  src="menu.js"></script>

</body>
</html>