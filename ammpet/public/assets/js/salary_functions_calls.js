$(document).ready(function(){
    
    document.getElementById("update_comission").onclick= function(event) {
        event.preventDefault();

        var year = document.getElementById("year").value;
        var month = document.getElementById("month").value;

        $.ajax({
            url: "/ammpet/public/Ajax_call",
            type: "POST",
            data: {
                    operation: "submit", 
                    class:"Salary", 
                    method:"update_comission", 
                    Year:year, 
                    Month:month
            },
            success: function(response){
                if ((typeof response === 'string' || response instanceof String)&&!(response==false)) {
                    document.getElementById('error_message').innerText = response;
                } else {
                    window.location.reload;
                }
              }
        });

      };

    function splitUrlEncoded(str) {
        var result = {};
        str.split('&').forEach(pair => {
          const [key, value] = pair.split('=');
          result[key] = value;
        });
        return result;
      }

});
