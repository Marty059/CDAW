<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques de l'utilisateur</title>
</head>
<body>
    <h1>Statistiques de l'utilisateur</h1>
    <p><strong>Nom d'utilisateur :</strong> {{ $user->username }}</p>
    <p><strong>Nombre de parties gagnées :</strong> {{ $partiesGagnees }}</p>
    <p><strong>Nombre de parties perdues :</strong> {{ $partiesPerdues }}</p>
    <p><strong>Nombre total de parties jouées :</strong> {{ $partiesJouees }}</p>
    <p><strong>Meilleur score :</strong> {{ $meilleurScore }}</p>
</body>
</html>
