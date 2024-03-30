<h1>Classement des joueurs</h1>

<table>
    <thead>
        <tr>
            <th>Classement</th>
            <th>Nom d'utilisateur</th>
            <th>Meilleur score</th>
        </tr>
    </thead>
    <tbody>
        @foreach($classement as $key => $joueur)
        <tr>
            <td>{{ $key + 1 }}</td> <!-- Ajoute 1 à $key car les index commencent généralement à 0 -->
            <td>{{ $joueur->username }}</td>
            <td>{{ $joueur->meilleur_score }}</td>
        </tr>
        @endforeach
    </tbody>
</table>