function format_table(){

    $('#_table tfoot th').each( function () {
        var title = $('#_table thead th').eq( $(this).index() ).text();
        if(title!=""){
            $(this).html( '<input type="text" size="8" placeholder="'+title+'" />' );
        }
    } );

    table = $('#_table').DataTable({
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
    $('#_table tbody th').css('text-align', 'center');

    // Apply the search
    table.columns().eq( 0 ).each( function ( colIdx ) {
        if( !table.settings()[0].aoColumns[colIdx].bSearchable ){
            table.column( colIdx ).footer().innerHTML=table.column( colIdx ).header().innerHTML;
        }
        $( 'input', table.column( colIdx ).footer() ).on( 'keyup change', function () {
            table
                .column( colIdx )
                .search( this.value )
                .draw();
        } );
    } );
}