$(document).ready(function(){
    $('#_table thead th').each( function () {
        var title = $('#_table tfoot th').eq( $(this).index() ).text();
        $(this).html( '&amp;lt;input type=&amp;quot;text&amp;quot; placeholder=&amp;quot;Search '+title+'&amp;quot; /&amp;gt;' );
    } );
 
    // DataTable
    let table = $('#_table').DataTable({
            lengthMenu: [
                [ 10, 25, 50, -1 ],
                [ '10 rows', '25 rows', '50 rows', 'Show all' ]
            ],
            buttons: ['copy', 'excel', 'pdf', 'print'],
            layout: {
                top: 'buttons',
                topStart: 'pageLength',
                topEnd: 'search',
                bottomStart: 'info',
                bottomEnd: 'paging',
                bottom2: 'searchBuilder',
            },
            columnDefs: [
                {
                    targets: 1,
                    render: DataTable.render.datetime('YYYY-MM-DD')
                }
                        ],
            "order": [[ 1, "desc" ]]
        });
 
    // Apply the search
    table.columns().eq( 0 ).each( function ( colIdx ) {
        $( 'input', table.column( colIdx ).header() ).on( 'keyup change', function () {
            table
                .column( colIdx )
                .search( this.value )
                .draw();
        } );
    } );
} );
