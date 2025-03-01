<?php

$select = "name_product,url_product,type_variant,media_variant,date_created_product,stock_variant,description_product";
$url = "relations?rel=variants,products&type=variant,product&linkTo=price_variant&equalTo=0&startAt=0&endAt=4&orderBy=id_variant&orderMode=DESC&select=" . $select;
$method = "GET";
$fields = array();

$freeProducts = CurlController::request($url, $method, $fields);

if ($freeProducts->status == 200) {

    $freeProducts = $freeProducts->results;
} else {

    $freeProducts = array();
}

if (count($freeProducts) == 0) {

    return;
}

?>

<div class="container-fluid bg-light border">

    <div class="container clearfix">

        <div class="btn-group float-end p-2">

            <button class="btn btn-default btnView bg-white" attr-type="grid" attr-index="1">

                <i class="fas fa-th fa-xs pe-1"></i>

                <span class="col-xs-0 float-end small mt-1">GRID</span>

            </button>

            <button class="btn btn-default btnView" attr-type="list" attr-index="1">

                <i class="fas fa-list fa-xs pe-1"></i>

                <span class="col-xs-0 float-end small mt-1">LIST</span>

            </button>

        </div>

    </div>

    <div class="container-fluid bg-white">

        <div class="container">

            <div class="clearfix pt-3 pb-0 px-2">

                <h4 class="float-start text-uppercase pt-2">Artículos Gratuitos</h4>

                <span class="float-end">

                    <a href="/free" class="btn btn-default templateColor">

                        <small>VER MÁS <i class="fas fa-chevron-right"></i></small>

                    </a>

                </span>

            </div>

            <hr style="color:#bbb">

            <!-- GRID -->

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 pt-3 pb-4 grid-1">

                <?php foreach ($freeProducts as $key => $value): ?>

                    <div class="col px-3 py-2 py-lg-0">

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

                            $date1 = new DateTime($value->date_created_product);
                            $date2 = new DateTime(date("Y-m-d"));
                            $diff = $date1->diff($date2);

                            ?>

                            <?php if ($diff->days < 30): ?>

                                <span class="badge badgeNew bg-warning text-uppercase text-white mt-1 p-2">Nuevo</span>

                            <?php endif ?>

                            <?php if ($value->stock_variant == 0 && $value->type_variant == "gallery"): ?>

                                <span class="badge bg-dark text-uppercase text-white mt-1 p-2">No tiene stock</span>

                            <?php endif ?>

                        </p>

                        <div class="clearfix">

                            <h5 class="float-start text-uppercase text-muted"><small>Gratis</small></h5>

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

            <div class="row list-1" style="display:none">

                <?php foreach ($freeProducts as $key => $value): ?>

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

                                $date1 = new DateTime($value->date_created_product);
                                $date2 = new DateTime(date("Y-m-d"));
                                $diff = $date1->diff($date2);

                                ?>

                                <?php if ($diff->days < 30): ?>

                                    <span class="badge badgeNew bg-warning text-uppercase text-white mt-1 p-2">Nuevo</span>

                                <?php endif ?>

                                <?php if ($value->stock_variant == 0 && $value->type_variant == "gallery"): ?>

                                    <span class="badge bg-dark text-uppercase text-white mt-1 p-2">No tiene stock</span>

                                <?php endif ?>

                            </p>



                            <p class="my-2"><?php echo $value->description_product ?></p>

                            <div class="clearfix">

                                <h5 class="float-start text-uppercase text-muted"><small>Gratis</small></h5>

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

        </div>

    </div>