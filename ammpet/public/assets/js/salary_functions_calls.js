$(document).ready(function(){
    
    document.getElementById("update_comission").onclick= function(event) {
        event.preventDefault();

        var year = document.getElementById("year").value;
        var month = document.getElementById("month").value;

        Swal.fire({
			title: "Atualizar Comissões?",
			text: "Não será possível desfazer!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#d33",
			cancelButtonColor: "#3085d6",
			confirmButtonText: "Sim!"
		}).then((result) => {
				if (result.isConfirmed) {
					//AJAX
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
                            window.location.reload();
                            if ((typeof response === 'string' || response instanceof String)&&(response.startsWith("Sucesso"))) {
                              //console.log("RESPONSE = SUCESSO");
                              document.getElementById('error_message').innerText = response;  
                            } else {
                              //console.log("RESPONSE = NOT SUCESSO");
                              document.getElementById('error_message').innerText = response;
                            }
                          }
                    });            
				}
			});
      };

      document.getElementById("batch_confirm").onclick= function(event) {
        event.preventDefault();

        var year = document.getElementById("year").value;
        var month = document.getElementById("month").value;

        Swal.fire({
			title: "Confirmar Todos os Registros do Período?",
			text: "Não será possível desfazer!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#d33",
			cancelButtonColor: "#3085d6",
			confirmButtonText: "Sim!"
		}).then((result) => {
				if (result.isConfirmed) {
					//AJAX
                    $.ajax({
                        url: "/ammpet/public/Ajax_call",
                        type: "POST",
                        data: {
                                operation: "submit", 
                                class:"Salary", 
                                method:"batch_confirm", 
                                Year:year, 
                                Month:month
                        },
                        success: function(response){
                          //window.location.reload();
                          document.getElementById('error_message').innerText = response;
                          //$( "#_list_id" ).load(window.location.href + " #_list_id" );
                          reload_rows();
                        }
                    });            
				}
			});

      };

      document.getElementById("close_period").onclick= function(event) {
        event.preventDefault();

        var year = document.getElementById("year").value;
        var month = document.getElementById("month").value;

        Swal.fire({
			title: "Encerrar período?",
			text: "Não será possível desfazer!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#d33",
			cancelButtonColor: "#3085d6",
			confirmButtonText: "Sim!"
		}).then((result) => {
				if (result.isConfirmed) {
					//AJAX
                    $.ajax({
                        url: "/ammpet/public/Ajax_call",
                        type: "POST",
                        data: {
                                operation: "submit", 
                                class:"Salary", 
                                method:"close_period", 
                                Year:year, 
                                Month:month
                        },
                        success: function(response){
                            if ((typeof response === 'string' || response instanceof String)&&!(response==false)) {
                                document.getElementById('error_message').innerText = response;
                            } else {
                                window.location.reload();
                            }
                          }
                    });            
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
