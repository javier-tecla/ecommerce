<?php

if (isset($_GET["ref"])) {

  $status = "pending";


  /*=============================================
  Consultar referencia
  =============================================*/

  // $url = "carts?linkTo=ref_cart&equalTo=".$_GET["ref"];
  $url = "relations?rel=carts,variants,products&type=cart,variant,product&linkTo=ref_cart&equalTo=" . $_GET["ref"];
  $method = "GET";
  $fields = array();

  // $refs = CurlController::request($url,$method,$fields);
  $carts = CurlController::request($url, $method, $fields);

  if ($carts->status == 200) {

    $carts = $carts->results;

    /*=============================================
    Validar el pago con PayPal
    =============================================*/

    if ($carts[0]->method_cart == "paypal") {

      $url = "v2/checkout/orders/" . $carts[0]->order_cart;
      $paypal = CurlController::paypal($url, $method, $fields);

      if ($paypal->status == "APPROVED") {

        $status = "ok";
      }
    }
  }

} else {

  echo '<script>
    window.location = "' . $path . '404";
 </script>';
}

?>

<!--==========================================
Breadcrumb
===========================================-->

<div class="container-fluid bg-light border mb-2">

  <div class="container py-3">

    <div class="d-flex flex-row-reverse lead small">

      <div class="px-1 font-weight-bold">¡Gracias por su compra!</div>
      <div class="px-1">/</div>
      <div class="px-1"><a href="/">Inicio</a></div>

    </div>

  </div>

</div>

<!--==========================================
Thanks
===========================================-->

<div class="container my-4">

  <div class="card">

    <div class="card-body bg-light">

      <div class="row row-cols-1 row-cols-lg-2">

        <div class="col">

          <?php include "modules/datos.php" ?>

        </div>

        <div class="col">

          <?php include "modules/carrito.php" ?>

        </div>

      </div>

    </div>

  </div>

</div>

