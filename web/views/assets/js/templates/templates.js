/*=============================================
Cambiar de Plantilla
=============================================*/

$(document).on("change",".changeTemplate", function(){

	var idTemplate =  $(this).attr("idItem");
	console.log("idTemplate", idTemplate);

	fncSweetAlert("confirm","¿Está seguro de activar esta plantilla?","").then(resp=>{

		if(resp){

			fncMatPreloader("on");
	      	fncSweetAlert("loading", "Cambiando plantilla...", "");

	      	var data = new FormData();
	      	data.append("token", localStorage.getItem("token-admin"));
	      	data.append("idTemplate", idTemplate);

	      	$.ajax({

	      		url: "/ajax/templates.ajax.php",
	      		method: "POST",
	      		data: data,
	      		contentType: false,
	      		cache: false,
	      		processData: false,
	      		success: function (response){

	      			if(response == 200){

	      				location.reload();
	      			
	      			}else{

		        		fncMatPreloader("off");
	            		fncToastr("Error","Error al modificar la plantilla");

		        	}

	      		}


	      	})

		}

	})

})
