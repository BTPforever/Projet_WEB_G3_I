
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil</title>
    <link rel="stylesheet" href="style/index.css">
</head>
<body>
    <article
    data-titre="<?php echo $event['titre']; ?>"
    data-date="<?php echo $event['evenDate']; ?>"
    data-lieu="<?php echo $event['lieu']; ?>"
    data-capacite="<?php echo $event['capacite']; ?>"
    data-description="<?php echo $event['evenDescription']; ?>">
    <h2><?php echo "+". $event['titre']; ?></h2>
</article>
</body>
</html>