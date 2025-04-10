$(document).ready(function(){
    
    let temp_id_employee = document.getElementById("temp_id_employee").value;

    load_employee(temp_id_employee);

});

function load_employee(dataformeemployee){  
    console.log("dataformeemployee-"+dataformeemployee);
    $.ajax({
      url: "/ammpet/public/Ajax_call",
      type: "POST",
      data: {class:"Supplier", method:"load_employee_options",  dfemployee: dataformeemployee},
      success: function(response){
        console.log(response);
          $('#id_employee').html(response);
      }
  });
  }