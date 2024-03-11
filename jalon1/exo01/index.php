<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heure courante</title>
</head>
<body>
    <h1>L'heure courante de votre machine est :</h1>
    <p>
        <?php
        date_default_timezone_set('Europe/Paris');
        $heureCourante = date("H:i:s");
        echo "Il est actuellement $heureCourante.";
        ?>
    </p>
</body>
</html>