$(document).ready(function() {
    $('#leaderboard-table').DataTable({
        ajax:{
            url: 'getLeaderboard',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
        },
        columns: [
            { data: null, render: function(data, type, row, meta) { 
                 //return meta.row + 1; 
                return row.id_user == currentUserId ? '<span class="current-user">' + (meta.row + 1) + '</span>' : (meta.row + 1); 
            } },
            { data: 'username', render: function(data, type, row) { 
                return row.id_user == currentUserId ? '<span class="current-user">' + data + '</span>' : data; 
            } },
            { data: 'meilleur_score', render: function(data, type, row) { 
                return row.id_user == currentUserId ? '<span class="current-user">' + data + '</span>' : data; 
            } },
            { 
                data: null,
                render: function(data, type, row) {
                    return '<div style="text-align: center;"><a href="/profile/' + data.id_user + '" class="btn btn-primary"><i class="bi bi-eye-fill"></i></a>';
                }
            },
        ],
         order: [[0, 'asc']], // Tri par ranking par défaut
         "columnDefs": [
        { "type": "num", "targets": [0,2] },
        { targets: [3], orderable: false } // Les deux dernières colonnes ne peuvent pas être triées
         // Remplacez 0 par l'index de la colonne que vous souhaitez ordonner comme un nombre
    ],
    lengthMenu: [[10, 25, 50, -1], [10, 25, 50,  "All"]], // Ajouter l'option "Tous"
        pageLength: 10 
    });
});