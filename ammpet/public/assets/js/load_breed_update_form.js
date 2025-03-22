$(document).ready(function(){
    breedType = document.getElementById("type").value;
    temp_breed = document.getElementById("temp_breed").value;
    getBreeds(breedType, temp_breed, "update");
});