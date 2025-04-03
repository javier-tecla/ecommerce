<?php 

class PaymentsController{

	/*=============================================
	Actualizar datos y pasarelas de pago
	=============================================*/	

	public function payment(){

		if(isset($_POST["optradio"])){

			echo '<script>

				fncMatPreloader("on");
				fncSweetAlert("loading", "procesando para pagar...", "");

			</script>';
			
			/*=============================================
    		Actualizar datos de usario en bd
    		=============================================*/

    		$url = "users?id=".$_SESSION["user"]->id_user."&nameId=id_user&token=".$_SESSION["user"]->token_user."&table=users&suffix=user";
    		$method = "PUT";
    		$fields = "name_user=".TemplateController::capitalize(trim($_POST["name_user"]))."&country_user=".explode("_",$_POST["country_user"])[0]."&department_user=".TemplateController::capitalize(trim($_POST["department_user"]))."&city_user=".TemplateController::capitalize(trim($_POST["city_user"]))."&address_user=".trim(urlencode($_POST["address_user"]))."&phone_user=".str_replace("+","",explode("_",$_POST["country_user"])[1])."_".str_replace("-","",$_POST["phone_user"]); 

    		$updateUser = CurlController::request($url, $method, $fields);

            if($updateUser->status == 200){

            	/*=============================================
				Traemos su carrito de compras
				=============================================*/

				$url = "relations?rel=carts,variants,products&type=cart,variant,product&linkTo=id_user_cart&equalTo=".$_SESSION["user"]->id_user;

				$method = "GET";
				$fields = array();

				$carts = CurlController::request($url,$method,$fields);

				if($carts->status == 200){
					
					$carts = $carts->results;
					$totalCart = 0;

					foreach ($carts as $key => $value) {
						
						if($value->offer_variant == 0){

							$totalCart += $value->price_variant*$value->quantity_cart;	

						}else{

							$totalCart += $value->offer_variant*$value->quantity_cart;	
							

						}

					}

					echo '<pre>'; print_r($totalCart); echo '</pre>';
						
				}

            }

		}

	}
}