function showHidePermission(){
    if(document.getElementById('login').value == null || document.getElementById('login').value == ''){
        document.getElementById('permission').style.display='none';
    } else {
        document.getElementById('permission').style.display='block';
    }
}

let checkbox = document.querySelector("input[type=checkbox]");

checkbox.addEventListener('change', function() {
  if (this.checked) {
    console.log("Checkbox is checked..");
  } else {
    console.log("Checkbox is not checked..");
  }
});

