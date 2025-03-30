//When the document is ready it loads the rows in table:
$(document).ready(function(){
                
//Function to call Modal for delete confirmation and execution - when success reloads table:
$("body").on("click", ".deleteXBtn", function(e){
    e.preventDefault();
    var tr = $(this).closest('tr');
    var del_id = $(this).attr('id');
    var order_id = $(this).attr('order_id');
    var package_id = $(this).attr('package_id');
    var classforjs = $(this).attr('classforjs');
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
                    data:{del_id:del_id, class:classforjs, method:"delete_call", order_id:order_id, package_id:package_id},
                    success:function(response){
                        tr.css('background-color', '#ff6666');
                        window.location.reload()
                    }
                });
            }
            });                    
});

});
