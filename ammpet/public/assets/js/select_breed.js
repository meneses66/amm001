function getBreedsNew(breedType, dataformbreed, operation){
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

function load_breed_new(breedType){
  //method_var = "load_breed_options_new("+breedType+")";  
  $.ajax({
    url: "/ammpet/public/Ajax_call",
    type: "POST",
    data: {operation:"new", class:"Breed", method:"load_breed_options", type:breedType},
    success: function(response){
        $('#id_breed').html(response);
    }
});
}

function getBreedsUpdate(breedType){
  let breedDropDown = document.getElementById("id_breed");
  if(breedType.trim() ===""){
    breedDropDown.disabled = true;
    breedDropDown.selectedIndex = 0;
    return false;
  } else{
    load_breed_update(breedType);
    breedDropDown.disabled = false;
  }
}

function load_breed_update(breedType, dataformbreed){  
  $.ajax({
    url: "/ammpet/public/Ajax_call",
    type: "POST",
    data: {operation:"update", class:"Breed", method:"load_breed_options_new", type:breedType, dfbreed: dataformbreed},
    success: function(response){
        $('#id_breed').html(response);
    }
});
}

function load_breed(breedType, dataformbreed, op){  
  $.ajax({
    url: "/ammpet/public/Ajax_call",
    type: "POST",
    data: {operation:op, class:"Breed", method:"load_breed_options", type:breedType, dfbreed: dataformbreed},
    success: function(response){
        $('#id_breed').html(response);
    }
});
}