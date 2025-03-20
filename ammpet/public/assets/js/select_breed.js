function getBreeds(breedType){
  let breedDropDown = document.getElementById("id_breed");
  if(breedType.trim() ===""){
    breedDropDown.disabled = true;
    breedDropDown.selectedIndex = 0;
    return false;
  } else{
    load_breed_new(breedType);
  }
}

function load_breed_new(breedType){
  //method_var = "load_breed_options_new("+breedType+")";  
  $.ajax({
    url: "/ammpet/public/Ajax_call",
    type: "POST",
    data: {operation:"get", class:"Breed", method:"load_breed_options_new", TYPE: breedType},
    success: function(response){
        $('#id_breed').html(response);
    }
});
}