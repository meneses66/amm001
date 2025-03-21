$(document).ready(function(){
    breedType = document.getElementById("type").value;
    temp_breed = document.getElementById("temp_breed").value;
    console.log(breedType + " - " + temp_breed);
    load_breed(breedType, temp_breed, "update");
});