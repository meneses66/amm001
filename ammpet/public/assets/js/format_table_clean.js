function format_table(){

    table = $('#_table').DataTable({
        lengthMenu: [
                        [ 10, 25, 50, -1 ],
                        [ '10 rows', '25 rows', '50 rows', 'Show all' ]
                    ],
        layout: {
            topStart: 'pageLength',
            topEnd: 'search',
            bottomStart: 'info',
            bottomEnd: 'paging',
        },
        columnDefs: [
            {
                targets: 1,
                render: DataTable.render.datetime('YYYY-MM-DD')
            }
                    ],
        "order": [[ 1, "desc" ]],
    });

    $('#_table thead th').css('text-align', 'center');

    $('#_table tfoot th').css('text-align', 'center');
    
}