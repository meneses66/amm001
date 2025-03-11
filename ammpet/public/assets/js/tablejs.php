<?php

$output = '<script type="text/javascript">
            //When the document is ready it loads the rows in table:

            //var current_class = '.$GLOBALS['classnamejs'].';
            $(document).ready(function(){
                
                load_rows();

            //Function to load the rows in table:
            function load_rows(){
                    $.ajax({
                        url: "/ammpet/public/Ajax_call",
                        type: "POST",
                        data: {operation:"view", class:"'.$GLOBALS['classnamejs'].'", method:"load_rows"},
                        success: function(response){
                            $(\'#_table\').html(response);
                            $.fn.dataTable.moment(\'DD/MM/YYYY\');
                            $("table").DataTable({
                                    columns:[
                                                {data: \'Updated\', render: function (data, type, row)
                                                 {return moment(new Date(data).toString()).format(\'DD/MM/YYYY\');}
                                                }
                                            ]
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