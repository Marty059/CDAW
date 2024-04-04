$(document).ready(function() {
    $('#users-table').DataTable({
        ajax:{
            url: 'getUsers',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
        },  

        columns: [
            { data: 'username'},
            { 
                data: 'email',
            },
            { data: 'country' },
            { data: 'created_at',
                render: function(data) {
                    var date = new Date(data);
                    var options = { year: 'numeric', month: 'short', day: 'numeric'};
                    var formattedDate = date.toLocaleDateString('en-EN', options);
                    return formattedDate + '<br>' + date.toLocaleTimeString('en-EN', {hour: '2-digit', minute: '2-digit'});
                },
                type: 'date'
            },
            { data: 'is_banned',
                render: function(data) {
                    return data ? 'Yes' : 'No';
                }
            },
            { data: null,
                render: function(data, type, row) {
                    if (data.is_banned) {
                        return '<div style="text-align: center;"><button class="btn btn-danger unban" data-id="' + data.id_user + '">Unban</button>';
                    } else {
                        return '<div style="text-align: center;"><button class="btn btn-warning ban" data-id="' + data.id_user + '">Ban</button>';
                    }
                },
            },
            { 
                data: null,
                data: null,
                render: function(data, type, row) {
                    return '<div style="text-align: center;"><a href="/profile/' + data.id_user + '" class="btn btn-primary"><i class="bi bi-eye-fill"></i></a></div>';
                }
            }
        ],
        columnDefs: [
            { targets: [-1, -2], orderable: false } // Les deux dernières colonnes ne peuvent pas être triées
        ],
        lengthMenu: [[50, 100, -1], [50, 100, "All"]], // Ajouter l'option "Tous"
        pageLength: 50
    });

    // Gestionnaire d'événement pour le bouton Ban / Unban
    $('#users-table').on('click', '.ban, .unban', function() {
        var userId = $(this).data('id');
        var action = $(this).hasClass('ban') ? 'ban' : 'unban';

        $.ajax({
            url: '/admin/ban-user/' + userId,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                action: action
            },
            success: function(response) {
                // Actualiser la table après l'action réussie
                $('#users-table').DataTable().ajax.reload();
            }
        });
    });
});
