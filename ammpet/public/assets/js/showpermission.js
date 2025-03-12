function showHidePermission(){
    if(document.getElementById('login').value == null){
        document.getElementById('permission').style.display='hidden';
    } else {
        document.getElementById('permission').style.display='none';
    }
}