<?php

$select = "*";
$url = "relations?rel=variants,products&type=variant,product&linkTo=url_product&equalTo=" . $routesArray[0] . "&select=" . $select;
$method = "GET";
$fields = array();

$product = CurlController::request($url, $method, $fields);

if ($product->status == 200) {

    $product = $product->results[0];
} else {

    echo '<script>
    window.location = "/404";
</script>';
}

?>

<div class="container-fluid bg-white">

    <hr style="color:#000">

    <div class="container py-4">

        <div class="row row-cols-1 row-cols-md-2">

        <!--=============================================
        Bloque Galeria o video
        =============================================-->

            <div class="col">

            <?php if ($product->type_variant == "gallery"): ?>

                <figure>

                    <img src="/views/assets/img/products/<?php echo $product->url_product ?>/<?php echo json_decode($product->media_variant)[0]?>" class="w-100 img-thumbnail">

                </figure>

            <?php else: $video = explode("/", $product->media_variant); ?>

                <iframe width="100%" height="315" src="https://www.youtube.com/embed/<?php echo end($video) ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>

            <?php endif ?>


            </div>

        <!--=============================================
        Bloque info del producto
        =============================================-->


            <div class="col">

            <!--=====================================
				Título
				======================================-->

				<h1 class="d-none d-md-block text-center">
			  		<?php echo $product->name_product ?>
			  		<br>
			  		
			  	</h1>

                


            </div>

        </div>

    </div>

</div>
