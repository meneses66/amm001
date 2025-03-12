function showHidePermission(){
    if(document.getElementById('login').value == null || document.getElementById('login').value == ''){
        document.getElementById('permission').style.display='none';
    } else {
        document.getElementById('permission').style.display='block';
    }
}