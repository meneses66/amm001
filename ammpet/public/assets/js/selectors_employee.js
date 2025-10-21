function load_employee(dataformeemployee){  
    //console.log("dataformeemployee-"+dataformeemployee);
    const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    $.ajax({
      url: "/ammpet/public/Ajax_call",
      type: "POST",
      data: {class:"Supplier", method:"load_employee_options", csrf_token: csrf, dfemployee: dataformeemployee},
      success: function(response){
        //console.log(response);
          $('#id_employee').html(response);
      }
  });
  }
