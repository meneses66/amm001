function getBreeds(breedType, dataformbreed, operation){
    console.log(breedType+"-"+dataformbreed+"-"+op);
    let breedDropDown = document.getElementById("id_breed");
    if(breedType.trim() ===""){
      breedDropDown.disabled = true;
      breedDropDown.selectedIndex = 0;
      return false;
    } else{
      if(operation==="new"){
      load_breed(breedType,"",operation);
      breedDropDown.disabled = false;
      } else if(operation.trim()==="update"){
        load_breed(breedType, dataformbreed, operation);
        breedDropDown.disabled = false;
      }
    }
  }

  function load_breed(breedType, dataformbreed, op){  
    //console.log(breedType+"-"+dataformbreed+"-"+op);
    $.ajax({
      url: "/ammpet/public/Ajax_call",
      type: "POST",
      data: {operation:op, class:"Breed", method:"load_breed_options", type:breedType, dfbreed: dataformbreed},
      success: function(response){
          $('#id_breed').html(response);
      }
  });
  }