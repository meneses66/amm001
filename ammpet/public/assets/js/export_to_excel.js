    $(function () 
    {
        var table = $('#_table').DataTable();
    
        $("#btnExport").click(function(e) 
        {
            e.preventDefault();
            table.page.len( -1 ).draw();
            window.open('data:application/vnd.ms-excel,' + 
                encodeURIComponent($('#_table').parent().html()));
            setTimeout(function(){
                table.page.len(10).draw();
            }, 1000)
    
        });
    });    
