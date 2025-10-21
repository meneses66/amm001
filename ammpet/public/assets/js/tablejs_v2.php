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
                                const csrf = document.querySelector("meta[name=\"csrf-token\"]").getAttribute("content");
                                $.ajax({
                                    url:"/ammpet/public/Ajax_call",
                                    type: "POST",
                                    data:{del_id:del_id, class:"'.$GLOBALS['classnamejs'].'", method:"delete_call", csrf_token: csrf},
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
                        const csrf = document.querySelector("meta[name=\"csrf-token\"]").getAttribute("content");
                        $.ajax({
                            url:"/ammpet/public/Ajax_call",
                            type: "POST",
                            data:{Id_client:cli_id, class:"Orderx", method:"insert_call", csrf_token: csrf},
                            success:function(response){
                                
                            }
                        });
                    
                });

            });

            //Function to load the rows in table:
            function load_rows(){
                const csrf = document.querySelector("meta[name=\"csrf-token\"]").getAttribute("content");
                $.ajax({
                    url: "/ammpet/public/Ajax_call",
                    type: "POST",
                    data: {operation:"view", class:"'.$GLOBALS['classnamejs'].'", method:"load_rows", csrf_token: csrf, cli_id: "'.$GLOBALS['cli_id_js'].'", order_id: "'.$GLOBALS['order_id_js'].'", buttons: "'.$GLOBALS['buttonenablerjs'].'"},
                    success: function(response){
                        $(\'#_table\').html(response);
                        format_table();
                    }
                });
            }

            //Function to reload the rows in table when record is deleted:
            function reload_rows(){
                const csrf = document.querySelector("meta[name=\"csrf-token\"]").getAttribute("content");
                $.ajax({
                        url: "/ammpet/public/Ajax_call",
                        type: "POST",
                        data: {operation:"view", class:"'.$GLOBALS['classnamejs'].'", method:"load_rows", csrf_token: csrf, cli_id: "'.$GLOBALS['cli_id_js'].'", order_id: "'.$GLOBALS['order_id_js'].'", buttons: "'.$GLOBALS['buttonenablerjs'].'"},
                        success: function(response){
                            table = $(\'#_table\').DataTable();
                            table.destroy();
                            $(\'#_table\').html(response);
                            format_table();
                        }
                });                    
            }

        </script>';
    
    echo $output;
