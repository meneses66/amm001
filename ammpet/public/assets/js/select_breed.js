function getBreedsNew(breedType){
  let breedDropDown = document.getElementById("id_breed");
  if(breedType.trim() ===""){
    breedDropDown.disabled = true;
    breedDropDown.selectedIndex = 0;
    return false;
  } else{
    load_breed_new(breedType);
    breedDropDown.disabled = false;
  }
}

function load_breed_new(breedType){
  //method_var = "load_breed_options_new("+breedType+")";  
  $.ajax({
    url: "/ammpet/public/Ajax_call",
    type: "POST",
    data: {operation:"get", class:"Breed", method:"load_breed_options_new", type:breedType},
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

function load_breed_update(breedType, dataformtype){
  //method_var = "load_breed_options_new("+breedType+")";  
  $.ajax({
    url: "/ammpet/public/Ajax_call",
    type: "POST",
    data: {operation:"get", class:"Breed", method:"load_breed_options_new", type:breedType, dftype: dataformtype},
    success: function(response){
        $('#id_breed').html(response);
    }
});
}