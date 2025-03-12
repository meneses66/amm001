function showHidePermission(){
    if(document.getElementById('login').value == null || document.getElementById('login').value == ''){
        document.getElementById('permission').style.display='none';
    } else {
        document.getElementById('permission').style.display='block';
    }
}

let checkboxes = $("input[type=checkbox]")
let enabledSettings = [];

// Attach a change event handler to the checkboxes.
checkboxes.change(function() {
  enabledSettings = checkboxes
    .filter(":checked") // Filter out unchecked boxes.
    .map(function() { // Extract values using jQuery map.
      return this.value;
    }) 
    .get() // Get array.
    
  console.log(enabledSettings);
});

