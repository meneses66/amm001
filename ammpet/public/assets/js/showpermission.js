function showHidePermission(){
    if(document.getElementById('login').value == null || document.getElementById('login').value == ''){
        document.getElementById('permission').style.display='none';
    } else {
        document.getElementById('permission').style.display='block';
    }
}


let checkboxes = document.querySelectorAll("input[type=checkbox]");

checkboxes.forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
    if (this.checked) {
        console.log("Checkbox is checked..");
    } else {
        console.log("Checkbox is not checked..");
    }
    })
});

