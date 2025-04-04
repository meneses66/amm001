    //When the document is ready it loads the rows in table:
    $(document).ready(function(){
        
        load_rows();

        //Function to load the rows in table:
        function load_rows(){
                $.ajax({
                    current_class: '<?php echo "Supplier" ?>',
                    url: "/ammpet/public/Ajax_call",
                    type: "POST",
                    data: {operation:"view", class:"Supplier", method:"load_rows"},
                    success: function(response){
                        $('#supplier_table').html(response);
                        $("table").DataTable({
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
                    data: {operation:"view", class:"Supplier", method:"load_rows"},
                    success: function(response){
                        table = $('#supplier_table').DataTable();
                        table.destroy();
                        $('#supplier_table').html(response);
                        $("table").DataTable({
                                "order": [[ 1, "desc" ]]
                            });
                    }
                });                    
            }

        //Function to call Modal for delete confirmation and execution - when success reloads table:
        $("body").on("click", ".deleteBtn", function(e){
            e.preventDefault();
            var tr = $(this).closest('tr');
            del_id = $(this).attr('id');
            Swal.fire({
                title: "Are you sure? Delete: " + del_id,
                text: "You won't be able to revert this!",
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
                            data:{del_id:del_id, class:"Supplier", method:"delete_call"},
                            success:function(response){
                                tr.css('background-color', '#ff6666');
                                reload_rows();
                            }
                        });
                    }
                    });                    
        });

        //Function to call Modal for delete Order Item confirmation and execution - it contains additional variables
        //  - when success reloads table:
        $("body").on("click", ".deleteOIBtn", function(e){
            e.preventDefault();
            var tr = $(this).closest('tr');
            del_id = $(this).attr('id');
            order_id = $(this).attr('order_id');
            package_id = $(this).attr('package_id');
            Swal.fire({
                title: "Are you sure? Delete: " + del_id,
                text: "You won't be able to revert this!",
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
                            data:{del_id:del_id, class:"Supplier", method:"delete_call", order_id:order_id, package_id:package_id},
                            success:function(response){
                                tr.css('background-color', '#ff6666');
                                reload_rows();
                            }
                        });
                    }
                    });                    
        });

    });
