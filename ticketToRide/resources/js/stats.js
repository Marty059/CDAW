$(document).ready(function() {
    $.fn.dataTable.moment('YYYY/M/D');
    $('#historique-table').DataTable({
        ajax:{
            url: baseUrl + '/getHistorique' + '/' + userId,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
        },  

        columns: [
            { 
                data: 'start_date',
                render: function(data) {
                    var date = new Date(data);
                    var options = { year: 'numeric', month: 'short', day: 'numeric'};
                    var formattedDate = date.toLocaleDateString('en-EN', options);
                    return formattedDate + '<br>' + date.toLocaleTimeString('en-EN', {hour: '2-digit', minute: '2-digit'});
                },
                type: 'date' 
            },
            { 
                data: 'duration',
                render: function(data) {
                    return data + ' minutes';
                },
                type: 'num'
            },
            { data: 'classement' },
            { data: 'score' },
            { data: 'joueurs' },
            { 
                data: null,
                render: function(data, type, row) {
                    return '<div style="text-align: center;"><a href="/game/stats/' + data.id_lobby + '" class="btn btn-primary"><i class="bi bi-eye-fill"></i></a>';
                }
            }
        ],
        columnDefs: [
            { targets: [-1, -2], orderable: false } // Les deux dernières colonnes ne peuvent pas être triées
        ],
        order: [[0, 'asc']],
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50,  "All"]], // Ajouter l'option "Tous"
        pageLength: 10         
    });
});