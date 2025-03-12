function showHidePermission(){
    if(document.getElementById('login').value == null || document.getElementById('login').value == ''){
        document.getElementById('permission').style.display='none';
    } else {
        document.getElementById('permission').style.display='block';
    }
}

function setPermission(){
    this.permissions=[];

    this.initialize = function(){
        this.registerEvents();
    },

    this.registerEvents = function(){
        document.addEventListener('click', function(e){
            let target = e.target;
            let permissionName = target.dataset.value;
            if(target.value.checked){
                script.permissions = script.permissions.filter((name) => {
                    return name !== permissionName;
                });
            } else {
                script.permissions.push(permissionName);
            }

            document.getElementById('permission_el')
                .value=script.permissions.join(',');

        });
    }
}

var script = new setPermission();
script.initialize();