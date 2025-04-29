$(document).ready(function(){
    $('#_table thead th').each( function () {
        var title = $('#_table tfoot th').eq( $(this).index() ).text();
        if(title!=""){
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
      }
    } );
  
    // DataTable
    var table = $('#_table').DataTable({
        });

    // Apply the search
    table.columns().eq( 0 ).each( function ( colIdx ) {
        if( !table.settings()[0].aoColumns[colIdx].bSearchable ){
        table.column( colIdx ).header().innerHTML=table.column( colIdx ).footer().innerHTML;
    }
        $( 'input', table.column( colIdx ).header() ).on( 'keyup change', function () {
            table
                .column( colIdx )
                .search( this.value )
                .draw();
        } );
    } );
} );
