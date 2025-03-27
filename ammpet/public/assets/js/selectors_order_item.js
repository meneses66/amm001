  function load_package(dataformpackage, id_client){  
    //console.log(breedType+"-"+dataformbreed+"-"+op);
    $.ajax({
      url: "/ammpet/public/Ajax_call",
      type: "POST",
      data: {class:"Package", method:"load_package_options",  dfpackage: dataformpackage, id_client: id_client},
      success: function(response){
          $('#package').html(response);
      }
  });
  }

  function load_executor(dataformexecutor){  
    //console.log(breedType+"-"+dataformbreed+"-"+op);
    $.ajax({
      url: "/ammpet/public/Ajax_call",
      type: "POST",
      data: {class:"Supplier", method:"load_executor_options",  dfexecutor: dataformexecutor},
      success: function(response){
          $('#executor').html(response);
      }
  });
  }

  function load_salesperson(dataformsalesperson){  
    //console.log(breedType+"-"+dataformbreed+"-"+op);
    $.ajax({
      url: "/ammpet/public/Ajax_call",
      type: "POST",
      data: {class:"Supplier", method:"load_salesperson_options",  dfexecutor: dataformsalesperson},
      success: function(response){
          $('#salesperson').html(response);
      }
  });
  }