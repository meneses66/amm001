$(document).ready(function(){
    $('#_table thead th').each( function () {
        var title = $('#_table tfoot th').eq( $(this).index() ).text();
        $(this).html( '&amp;lt;input type=&amp;quot;text&amp;quot; placeholder=&amp;quot;Search '+title+'&amp;quot; /&amp;gt;' );
    } );
 
    // DataTable
    let table = $('#_table').DataTable();
 
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
