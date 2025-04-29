$(document).ready(function(){
    // Setup - add a text input to each header cell
    $('#_table thead th').each(function() {
        var title = $('#_table thead th').eq($(this).index()).text();
        $(this).html('&lt;input type=&quot;text&quot; placeholder=&quot;Search ' + title + '&quot; /&gt;');
    });
    
    // DataTable
    //var table = $('#_table').DataTable();
    var table = $('#_table').DataTable( {
        //paging: false,
        searching: false
    } );
    
    // Apply the search
    table.columns().eq(0).each(function(colIdx) {
        $('input', table.column(colIdx).header()).on('keyup change', function() {
            table
                .column(colIdx)
                .search(this.value)
                .draw();
        });
    
        $('input', table.column(colIdx).header()).on('click', function(e) {
            e.stopPropagation();
        });
});

} );
