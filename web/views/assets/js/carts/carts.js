/*=============================================
Aumentar y disminuir la cantidad
=============================================*/

$(document).on("click",".btnInc", function() {

    let key = $(this).attr("key");

    if ($(this).attr("type") == "btnMin") {

        if (Number($(".showQuantity_"+key).val()) > 1) {

            $(".showQuantity_"+key).val(Number($(".showQuantity_"+key).val()) - 1);

        }
    }

    if ($(this).attr("type") == "btnMax") {

        $(".showQuantity_"+key).val(Number($(".showQuantity_"+key).val()) + 1);

    }

    /*=============================================
	Actualizamos el subtotal
	=============================================*/

	let quantity = $(".showQuantity_"+key).val();
	let price = $(".priceCart_"+key).html();

	$(".subtotalCart_"+key).html((Number(quantity)*Number(price)).toFixed(2));


    /*=============================================
	Actualizamos el total
	=============================================*/

	let sumaSubtotal = $(".subtotalCart");
	let total = 0;

	sumaSubtotal.each((i)=>{

		total += Number($(sumaSubtotal[i]).html());	

	})

	$(".totalCart").html(total.toFixed(2));


    /*=============================================
	Actualizamos la cesta
	=============================================*/

	let showQuantity = $(".showQuantity");
	let shoppingBasket = 0;

	showQuantity.each((i)=>{

		shoppingBasket += Number($(showQuantity[i]).val());

	})

	$("#shoppingBasket").html(shoppingBasket);
	$("#totalShop").html(total.toFixed(2));


    /*=============================================
	Actualizamos base de datos
	=============================================*/

	let idCart =  $(this).attr("idCart");

	let data = new FormData();
	data.append("token", localStorage.getItem("token-user"));
	data.append("idCartUpdate", idCart);
	data.append("quantityCartUpdate", quantity);

	$.ajax({
	  
	  	url:"/ajax/forms.ajax.php",
	  	method: "POST",
	  	data: data,
	  	contentType: false,
	  	cache: false,
	  	processData: false,
	  	success: function (response){ 
	  		
	  		if(response == 200){

	  			fncToastr("success","El producto ha sido actualizado");
	  		}

	  	}

	 })

})

 /*=============================================
Quitar del carrito de compras
=============================================*/

$(document).on("click",".remCart", function(){

	fncSweetAlert("confirm","¿Está seguro de borrar este item?","").then(resp=>{

		if(resp){

			let key = $(this).attr("key");

			$(".hr_"+key).remove();

			$(this).parent().parent().remove();

			let idCart = $(this).attr("idCart");	

			let data = new FormData();

			data.append("token", localStorage.getItem("token-user"));
		    data.append("idCartDelete", idCart);

		     $.ajax({
		    
		        url:"/ajax/forms.ajax.php",
		        method: "POST",
		        data: data,
		        contentType: false,
		        cache: false,
		        processData: false,
		        success: function (response){
		        	
		        	if(response == 200){

		        		let total = 0;

		        	}

		        }

		    })

		}

	})

})						
