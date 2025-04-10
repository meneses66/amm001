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