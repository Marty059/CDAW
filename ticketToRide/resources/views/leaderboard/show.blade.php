<h1>hello</h1>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Score</th>
        </tr>
    </thead>
    <tbody>
        @foreach($classement as $player)
        <tr>
            <!-- <td>{{ $player['name'] }}</td> -->
            <td>{{ $player}}</td>
        </tr>
        @endforeach
    </tbody>
</table>