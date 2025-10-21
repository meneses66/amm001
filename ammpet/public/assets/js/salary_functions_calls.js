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
                    const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    $.ajax({
                        url: "/ammpet/public/Ajax_call",
                        type: "POST",
                        data: {
                                operation: "submit", 
                                class:"Salary", 
                                method:"update_comission", 
                                csrf_token: csrf,
                                Year:year, 
                                Month:month
                        },
                        success: function(response){
                            document.getElementById('error_message').innerText = response;
                            reload_rows();
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
                    const csrf2 = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    $.ajax({
                        url: "/ammpet/public/Ajax_call",
                        type: "POST",
                        data: {
                                operation: "submit", 
                                class:"Salary", 
                                method:"batch_confirm", 
                                csrf_token: csrf2,
                                Year:year, 
                                Month:month
                        },
                        success: function(response){
                          document.getElementById('error_message').innerText = response;
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
                    const csrf3 = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    $.ajax({
                        url: "/ammpet/public/Ajax_call",
                        type: "POST",
                        data: {
                                operation: "submit", 
                                class:"Salary", 
                                method:"close_period", 
                                csrf_token: csrf3,
                                Year:year, 
                                Month:month
                        },
                        success: function(response){
                            document.getElementById('error_message').innerText = response;
                            reload_rows();
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
