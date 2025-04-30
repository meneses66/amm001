            $(document).ready(function(){
                
                var classnamejs = document.getElementById('classnamejs').value;
                var cli_id_js = document.getElementById('cli_id_js').value;
                var order_id_js = document.getElementById('order_id_js').value;
                var buttonenablerjs = document.getElementById('buttonenablerjs').value;
                load_rows();

                //Function to call Modal for delete confirmation and execution - when success reloads table:
                $("body").on("click", ".deleteBtn", function(e){
                    e.preventDefault();
                    var tr = $(this).closest('tr');
                    var del_id = $(this).attr('id');
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
                                    data:{del_id:del_id, class:classnamejs, method:"delete_call"},
                                    success:function(response){
                                        tr.css('background-color', '#ff6666');
                                        reload_rows();
                                    }
                                });
                            }
                        });                    
                });

                $("body").on("click", ".newOrderBtnX", function(e){
                    e.preventDefault();
                    var tr = $(this).closest('tr');
                    cli_id = $(this).attr('cli_id');
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
                    data: {operation:"view", class:classnamejs, method:"load_rows", cli_id:cli_id_js, order_id:order_id_js, buttons:buttonenablerjs},
                    success: function(response){
                        $('#_table').html(response);
                        format_table();
                    }
                });
            }

            //Function to reload the rows in table when record is deleted:
            function reload_rows(){
                $.ajax({
                        url: "/ammpet/public/Ajax_call",
                        type: "POST",
                        data: {operation:"view", class:classnamejs, method:"load_rows", cli_id:cli_id_js, order_id:order_id_js, buttons:buttonenablerjs},
                        success: function(response){
                            table = $('#_table').DataTable();
                            table.destroy();
                            $('#_table').html(response);
                            format_table();
                        }
                });                    
            }