function getBreeds(breedType){
  let breedDropDown = document.getElementById("id_breed");
  if(breedType.trim() ===""){
    breedDropDown.disabled = true;
    breedDropDown.selectedIndex = 0;
    return false;
  }
  $.ajax({
    url: "/ammpet/public/Ajax_call",
    type: "POST",
    data: {operation:"view", class:"Breed", method:"load_breed_options_new("+breedType+")"},
    success: function(response){
        $('#breed_id').html(response);
    }
});

}