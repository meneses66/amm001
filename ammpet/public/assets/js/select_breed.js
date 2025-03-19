function getBreeds(breedType){
  let breedDropDown = document.getElementById("id_breed");
  if(breedType.trim() ===""){
    breedDropDown.disabled = true;
    breedDropDown.selectedIndex = 0;
    return false;
  } else{
    load_Breed_new();
  }
}

function load_breed_new(){  
  $.ajax({
    url: "/ammpet/public/Ajax_call",
    type: "POST",
    data: {operation:"get", class:"Breed", method:"load_breed_options_new("+breedType+")"},
    success: function(response){
        $('#id_breed').html(response);
    }
});
}