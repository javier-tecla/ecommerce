<?php

$url = "users?linkTo=id_user&equalTo=".$_SESSION["user"]->id_user;
$method = "GET";
$fields = array();

$user = CurlController::request($url,$method,$fields)->results[0];

$status = "ok";

?>

<div class="d-flex p-3">

	<h1 class="my-3"><i class="far fa-check-circle fa-lg"></i></h1>
	<div class="align-self-center pl-3">
		<p class="m-0">Código del pedido - <strong><?php echo $_GET["ref"] ?></strong></p>
		<h4>¡Gracias, <?php echo $user->name_user ?>!</h4>
	</div>

</div>

<div class="px-2">
	
	<div class="pt-3 p-2 border rounded-bottom bg-white">

		<?php if ($status == "ok"): ?>
			<h6>Tu pedido está confirmado</h6>
			<p class="small">Recibirás el producto en la puerta de tu casa</p>
		<?php else: ?>
			<h6>Tu pedido está en proceso de confirmación</h6>
			<p class="small">Cuando el pedido esté confirmado recibirás el producto en la puerta de tu casa</p>		
		<?php endif ?>
				
	</div>

</div>

<div class="mx-2 mt-3 p-2 rounded border bg-white">
				
	<div class="mt-3"> Detalles del pedido</div>

	<div class="row row-cols-1 row-cols-sm-2 px-2">

		<div class="col my-3">

			<p class="small m-0 p-0"><strong>Información del contacto</strong></p>
			<p class="small m-0 p-0"><?php echo $user->email_user ?></p>

			<p class="small m-0 p-0 mt-3"><strong>Dirección de envío</strong></p>
			<p class="small m-0 p-0"><?php echo $user->name_user ?></p>
			<p class="small m-0 p-0"><?php echo $user->address_user ?></p>
			<p class="small m-0 p-0"><?php echo $user->country_user ?></p>
			<p class="small m-0 p-0"><?php echo $user->city_user ?>, <?php echo $user->department_user ?></p>
			<p class="small m-0 p-0"><?php echo $user->phone_user ?></p>

		</div>
	  
	  	<div class="col my-3">

	  		
	  		<p class="small m-0 p-0"><strong>Método de pago</strong></p>
			<p class="small m-0 p-0">Pasarela de pagos</p>

	  	</div>
	</div>

</div>