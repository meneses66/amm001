$(document).ready(function(){
    breedType = document.getElementById("type").value;
    temp_breed = document.getElementById("temp_breed").value;
    console.log(breedType + " - " + temp_breed);
    console.log(getBreeds(breedType, temp_breed, "update"));
    getBreeds(breedType, temp_breed, "update");
});