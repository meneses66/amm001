function showHidePermission(login){
    if(login == null || login == ""){
        document.getElementById('permission_div').style.display='none';
    } else {
        document.getElementById('permission_div').style.display='block';
    }
}

function showHidePermission2(login){
    if(document.getElementById('login').value == null || document.getElementById('login').value == ''){
        document.getElementById('permission_div').style.display='none';
    } else {
        document.getElementById('permission_div').style.display='block';
    }
}

let checkboxes = document.querySelectorAll("input[type=checkbox]");
//let enabledSettings = document.getElementById("permission_el").value;
let enabledSettings = [];

checkboxes.forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {

        enabledSettings = 
        Array.from(checkboxes) // Convert checkboxes to an array to use filter and map.
        .filter(i => i.checked) // Use Array.filter to remove unchecked checkboxes.
        .map(i => i.value); // Use Array.map to extract only the checkbox values from the array of objects.
      
        console.log(enabledSettings);

        document.getElementById('permission_el').value = enabledSettings;
        
    })
});