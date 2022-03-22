var table =
$('#history')
    .DataTable({
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        info: false,
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
    })
    .buttons()
    .container()
    .appendTo('#history_wrapper .col-md-6:eq(0)');

