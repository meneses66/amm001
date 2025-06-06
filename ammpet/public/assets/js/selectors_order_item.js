  function load_package(dataformpackage, id_client){  
    //console.log("dataformpackage-"+dataformpackage+"id_client-"+id_client);
    $.ajax({
      url: "/ammpet/public/Ajax_call",
      type: "POST",
      data: {class:"Package", method:"load_package_options",  dfpackage: dataformpackage, id_client: id_client},
      success: function(response){
          $('#id_package').html(response);
      }
  });
  }

  function load_executor(dataformexecutor){  
    //console.log("dataformexecutor-"+dataformexecutor);
    $.ajax({
      url: "/ammpet/public/Ajax_call",
      type: "POST",
      data: {class:"Supplier", method:"load_executor_options",  dfexecutor: dataformexecutor},
      success: function(response){
        //console.log(response);
          $('#serv_executor').html(response);
      }
  });
  }

  function load_salesperson(dataformsalesperson){  
    //console.log("dataformsalesperson-"+dataformsalesperson);
    $.ajax({
      url: "/ammpet/public/Ajax_call",
      type: "POST",
      data: {class:"Supplier", method:"load_salesperson_options",  dfsalesperson: dataformsalesperson},
      success: function(response){
          $('#salesperson').html(response);
      }
  });
  }

  function load_animals(temp_id_animal_pkg, id_client){  
    //console.log("dataformpackage-"+dataformpackage+"id_client-"+id_client);
    $.ajax({
      url: "/ammpet/public/Ajax_call",
      type: "POST",
      data: {class:"Animal", method:"load_animal_options",  data_form_info: temp_id_animal_pkg, id_client: id_client},
      success: function(response){
          $('#id_package_animal').html(response);
      }
  });

  }