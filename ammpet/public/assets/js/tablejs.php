<?php

$output = '<script type="text/javascript">
            //When the document is ready it loads the rows in table:

            $(document).ready(function(){
                
                load_rows();

            //Function to load the rows in table:
            function load_rows(){
                captured_cli_id = '.(($GLOBALS['cli_id_js']!="" AND $GLOBALS['cli_id_js']!=null )?$GLOBALS['cli_id_js']:"").'
                if (captured_cli_id = "") {
                    v_url = "/ammpet/public/Ajax_call";
                } else{
                    v_url = "/ammpet/public/Ajax_call?cli_id="+captured_cli_id;
                }
                    $.ajax({
                        //url: "/ammpet/public/Ajax_call",
                        url: v_url,
                        type: "POST",
                        data: {operation:"view", class:"'.$GLOBALS['classnamejs'].'", method:"load_rows", cli_id: "'.$GLOBALS['cli_id_js'].'"},
                        success: function(response){
                            $(\'#_table\').html(response);
                            $("table").DataTable({
                                    columnDefs: [
                                                    {
                                                        targets: 1,
                                                        render: DataTable.render.datetime(\'YYYY-MM-DD\')
                                                    }
                                                ],
                                    "order": [[ 1, "desc" ]]
                                });
                        }
                    });
                }

            //Function to reload the rows in table when record is deleted:
            function reload_rows(){
                $.ajax({
                        url: "/ammpet/public/Ajax_call",
                        type: "POST",
                        data: {operation:"view", class:"'.$GLOBALS['classnamejs'].'", method:"load_rows"},
                        success: function(response){
                            table = $(\'#_table\').DataTable();
                            table.destroy();
                            $(\'#_table\').html(response);
                            $("table").DataTable({
                                    columnDefs: [
                                                    {
                                                        targets: 1,
                                                        render: DataTable.render.datetime(\'YYYY-MM-DD\')
                                                    }
                                                ],
                                    "order": [[ 1, "desc" ]]
                                });
                        }
                    });                    
                }

            //Function to call Modal for delete confirmation and execution - when success reloads table:
            $("body").on("click", ".deleteBtn", function(e){
                e.preventDefault();
                var tr = $(this).closest(\'tr\');
                del_id = $(this).attr(\'id\');
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

            });
        </script>';
    
    echo $output;