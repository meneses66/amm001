<?php

$output = '<script type="text/javascript">
            //When the document is ready it loads the rows in table:

            $(document).ready(function(){
                
                load_rows();

                //Function to call Modal for delete confirmation and execution - when success reloads table:
                $("body").on("click", ".deleteBtn", function(e){
                    e.preventDefault();
                    var tr = $(this).closest(\'tr\');
                    var del_id = $(this).attr(\'id\');
                    Swal.fire({
                        title: "Are you sure? Delete: " + del_id,
                        text: "You won\'t be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url:"/ammpet/public/Ajax_call",
                                    type: "POST",
                                    data:{del_id:del_id, class:"'.$GLOBALS['classnamejs'].'", method:"delete_call"},
                                    success:function(response){
                                        tr.css(\'background-color\', \'#ff6666\');
                                        reload_rows();
                                    }
                                });
                            }
                        });                    
                });

                $("body").on("click", ".newOrderBtnX", function(e){
                    e.preventDefault();
                    var tr = $(this).closest(\'tr\');
                    cli_id = $(this).attr(\'cli_id\');
                        $.ajax({
                            url:"/ammpet/public/Ajax_call",
                            type: "POST",
                            data:{Id_client:cli_id, class:"Orderx", method:"insert_call"},
                            success:function(response){
                                
                            }
                        });
                    
                });

            });

            //Function to load the rows in table:
            function load_rows(){
                $.ajax({
                    url: "/ammpet/public/Ajax_call",
                    type: "POST",
                    data: {operation:"view", class:"'.$GLOBALS['classnamejs'].'", method:"load_rows", cli_id: "'.$GLOBALS['cli_id_js'].'", order_id: "'.$GLOBALS['order_id_js'].'", buttons: "'.$GLOBALS['buttonenablerjs'].'"},
                    success: function(response){
                        $(\'#_table\').html(response);
                        format_table();
                    }
                });
            }

            //Function to reload the rows in table when record is deleted:
            function reload_rows(){
                $.ajax({
                        url: "/ammpet/public/Ajax_call",
                        type: "POST",
                        data: {operation:"view", class:"'.$GLOBALS['classnamejs'].'", method:"load_rows", cli_id: "'.$GLOBALS['cli_id_js'].'", order_id: "'.$GLOBALS['order_id_js'].'", buttons: "'.$GLOBALS['buttonenablerjs'].'"},
                        success: function(response){
                            table = $(\'#_table\').DataTable();
                            table.destroy();
                            $(\'#_table\').html(response);
                            format_table();
                        }
                });                    
            }

            function format_table(){

                $(\'#_table tfoot th\').each( function () {
                    var title = $(\'#_table thead th\').eq( $(this).index() ).text();
                    if(title!=""){
                        $(this).html( \'<input type="text" size="8" placeholder="\'+title+\'" />\' );
                    }
                } );

                table = $(\'#_table\').DataTable({
                    lengthMenu: [
                                    [ 10, 25, 50, -1 ],
                                    [ \'10 rows\', \'25 rows\', \'50 rows\', \'Show all\' ]
                                ],
                    buttons: [\'copy\', \'excel\', \'pdf\', \'print\'],
                    layout: {
                        top: \'buttons\',
                        topStart: \'pageLength\',
                        topEnd: \'search\',
                        bottomStart: \'info\',
                        bottomEnd: \'paging\',
                    },
                    columnDefs: [
                        {
                            targets: 1,
                            render: DataTable.render.datetime(\'YYYY-MM-DD\')
                        }
                                ],
                    "order": [[ 1, "desc" ]],
                });

                // Apply the search
                table.columns().eq( 0 ).each( function ( colIdx ) {
                    if( !table.settings()[0].aoColumns[colIdx].bSearchable ){
                        table.column( colIdx ).footer().innerHTML=table.column( colIdx ).header().innerHTML;
                    }
                    $( \'input\', table.column( colIdx ).footer() ).on( \'keyup change\', function () {
                        table
                            .column( colIdx )
                            .search( this.value )
                            .draw();
                    } );
                } );
            }

        </script>';
    
    echo $output;