<?php

/*=============================================
    Configuracion de la paginación
    =============================================*/

$endAt = 12;

if (isset($routesArray[1]) && !empty($routesArray[1])) {

    $startAt = ($routesArray[1] - 1) * $endAt;
    $currentPage = $routesArray[1];
} else {

    $startAt = 0;
    $currentPage = 1;
}

/*=============================================
    Traemos productos relacionados con cateorias
    =============================================*/

$url = "relations?rel=products,categories&type=product,category&linkTo=url_category&equalTo=" . $routesArray[0] . "&select=id_product";
$totalProducts = CurlController::request($url, $method, $fields)->total;

if ($startAt > $totalProducts) {

    echo '<script>
            window.location = "/404";
        </script>';
}

$select = "id_product,name_product,url_product,description_product";
$url = "relations?rel=products,categories&type=product,category&linkTo=url_category&equalTo=" . $routesArray[0] . "&select=" . $select . "&startAt=" . $startAt . "&endAt=" . $endAt . "&orderBy=id_product&orderMode=DESC";
$method = "GET";
$fields = array();

$products = CurlController::request($url, $method, $fields);

if ($products->status == 200) {

    $products = $products->results;
} else {

    /*=============================================
    Anulamos ingreso al catalogo
    =============================================*/
}

/*=============================================
 Traemos la primera variante de los productos
 =============================================*/

if (!empty($products)) {

    foreach ($products as $key => $value) {

        $select = "type_variant,media_variant,price_variant,offer_variant,end_offer_variant,stock_variant,date_created_variant";
        $url = "variants?linkTo=id_product_variant&equalTo=" . $value->id_product . "&select=" . $select;
        $variant = CurlController::request($url, $method, $fields)->results[0];

        $products[$key]->type_variant = $variant->type_variant;
        $products[$key]->media_variant = $variant->media_variant;
        $products[$key]->price_variant = $variant->price_variant;
        $products[$key]->offer_variant = $variant->offer_variant;
        $products[$key]->end_offer_variant = $variant->end_offer_variant;
        $products[$key]->stock_variant = $variant->stock_variant;
        $products[$key]->date_created_variant = $variant->date_created_variant;
    }
}

?>

<div class="container-fluid bg-light border">

    <div class="container clearfix">

        <div class="btn-group float-end p-2">

            <button class="btn btn-default btnView bg-white" attr-type="grid" attr-index="2">

                <i class="fas fa-th fa-xs pe-1"></i>

                <span class="col-xs-0 float-end small mt-1">GRID</span>

            </button>

            <button class="btn btn-default btnView" attr-type="list" attr-index="2">

                <i class="fas fa-list fa-xs pe-1"></i>

                <span class="col-xs-0 float-end small mt-1">LIST</span>

            </button>

        </div>

    </div>

</div>


<div class="container-fluid bg-white">

    <div class="container">

        <!-- GRID -->

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 pt-3 pb-4 grid-2">

            <?php foreach ($products as $key => $value): ?>

                <div class="col px-3 py-3">

                    <a href="/<?php echo $value->url_product ?>">

                        <figure class="imgProduct">

                            <?php if ($value->type_variant == "gallery"): ?>

                                <img src="<?php echo $path ?>views/assets/img/products/<?php echo $value->url_product ?>/<?php echo json_decode($value->media_variant)[0] ?>" class="img-fluid">

                            <?php else: $arrayYT = explode("/", $value->media_variant) ?>

                                <img src="http://imgyoutube.com/vi/<?php echo end($arrayYT) ?>maxresdefault.jpg" class="img-fluid bg-light">

                            <?php endif ?>

                        </figure>

                        <h5><small class="text-uppercase text-muted"><?php echo $value->name_product ?></small></h5>

                    </a>

                    <p class="small">

                        <?php

                        $date1 = new DateTime($value->date_created_variant);
                        $date2 = new DateTime(date("Y-m-d"));
                        $diff = $date1->diff($date2);

                        ?>

                        <?php if ($diff->days < 30): ?>

                            <span class="badge badgeNew bg-warning text-uppercase text-white mt-1 p-2">Nuevo</span>

                        <?php endif ?>

                        <?php if ($value->offer_variant > 0): ?>

                            <span class="badge bg-danger text-uppercase text-white mt-1 p-2">¡En oferta!</span>

                        <?php endif ?>

                        <?php if ($value->stock_variant == 0 && $value->type_variant == "gallery"): ?>

                            <span class="badge bg-dark text-uppercase text-white mt-1 p-2">No tiene stock</span>

                        <?php endif ?>

                    </p>

                    <div class="clearfix">

                        <h5 class="float-start text-uppercase text-muted">

                            <?php if ($value->offer_variant > 0): ?>
                                <del class="small" style="color:#bbb">
                                    USD $<?php echo $value->price_variant ?>
                                </del> $<?php echo $value->offer_variant ?>
                            <?php else: ?>
                                $<?php echo $value->price_variant ?>
                            <?php endif ?>
                        </h5>

                        <span class="float-end">

                            <div class="btn-group btn-group-sm">

                                <button type="button" class="btn btn-light border">
                                    <i class="fas fa-heart"></i>
                                </button>

                                <button type="button" class="btn btn-light border" onclick="location.href='/<?php echo $value->url_product ?>'">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>

                        </span>

                    </div>

                </div>

            <?php endforeach ?>

        </div>

        <!-- LIST -->

        <div class="row list-2" style="display:none">

            <?php foreach ($products as $key => $value): ?>

                <div class="media border-bottom px-3 pt-4 pb-3 pb-lg-2">

                    <a href="/<?php echo $value->url_product ?>">

                        <figure class="imgProduct">

                            <?php if ($value->type_variant == "gallery"): ?>

                                <img src="<?php echo $path ?>views/assets/img/products/<?php echo $value->url_product ?>/<?php echo json_decode($value->media_variant)[0] ?>" class="img-fluid" style="width:150px">

                            <?php else: $arrayYT = explode("/", $value->media_variant) ?>

                                <img src="http://imgyoutube.com/vi/<?php echo end($arrayYT) ?>maxresdefault.jpg" class="img-fluid bg-light" style="width:150px">

                            <?php endif ?>

                        </figure>

                    </a>
                    <div class="media-body ps-3">

                        <a href="/<?php echo $value->url_product ?>">
                            <h5><small class="text-uppercase text-muted"><?php echo $value->name_product ?></small></h5>
                        </a>

                        <p class="small">

                            <?php

                            $date1 = new DateTime($value->date_created_variant);
                            $date2 = new DateTime(date("Y-m-d"));
                            $diff = $date1->diff($date2);

                            ?>

                            <?php if ($diff->days < 30): ?>

                                <span class="badge badgeNew bg-warning text-uppercase text-white mt-1 p-2">Nuevo</span>

                            <?php endif ?>

                            <?php if ($value->offer_variant > 0): ?>

                                <span class="badge bg-danger text-uppercase text-white mt-1 p-2">¡En oferta!</span>

                            <?php endif ?>

                            <?php if ($value->stock_variant == 0 && $value->type_variant == "gallery"): ?>

                                <span class="badge bg-dark text-uppercase text-white mt-1 p-2">No tiene stock</span>

                            <?php endif ?>

                        </p>

                        <p class="my-2"><?php echo $value->description_product ?></p>

                        <div class="clearfix">

                            <h5 class="float-start text-uppercase text-muted">
                                <?php if ($value->offer_variant > 0): ?>
                                    <del class="small" style="color:#bbb">
                                        USD $<?php echo $value->price_variant ?>
                                    </del> $<?php echo $value->offer_variant ?>
                                <?php else: ?>
                                    $<?php echo $value->price_variant ?>
                                <?php endif ?>
                            </h5>

                            <span class="float-end">

                                <div class="btn-group btn-group-sm">

                                    <button type="button" class="btn btn-light border">
                                        <i class="fas fa-heart"></i>
                                    </button>

                                    <button type="button" class="btn btn-light border">
                                        <i class="fas fa-eye" onclick="location.href='/<?php echo $value->url_product ?>'"></i>
                                    </button>
                                </div>

                            </span>

                        </div>

                    </div>

                </div>

            <?php endforeach ?>

        </div>

        <!-- PAGINACIÓN -->

        <div class="d-flex justify-content-center mt-3 my-5">

            <div class="cont-pagination">

                <ul"
                    class="pagination"
                    data-total-pages="<?php echo ceil($totalProducts / $endAt) ?>"
                    data-url-page="<?php echo $routesArray[0] ?>"
                    data-current-page="<?php echo $currentPage ?>">
                    </ul>

            </div>

        </div>

    </div>

</div>