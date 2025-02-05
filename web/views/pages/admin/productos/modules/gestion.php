<?php

if (isset($_GET["product"])) {

    $select = "id_subcategory,name_subcategory,url_subcategory,image_subcategory,description_subcategory,keywords_subcategory,id_category_subcategory";
    $url = "subcategories?linkTo=id_subcategory&equalTo=" . base64_decode($_GET["subcategory"]) . "&select=" . $select;
    $method = "GET";
    $fields = array();

    $subcategory = CurlController::request($url, $method, $fields);

    if ($subcategory->status == 200) {

        $subcategory = $subcategory->results[0];
    } else {

        $subcategory = null;
    }
} else {

    $subcategory = null;
}


?>

<div class="content pb-5">

    <div class="container">

        <div class="card">

            <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

                <?php if (!empty($subcategory)): ?>

                    <input type="hidden" name="idSubcategory" value="<?php echo base64_encode($subcategory->id_subcategory) ?>">

                <?php endif ?>

                <div class="card-header">

                    <div class="container">

                        <div class="row">

                            <div class="col-12 col-lg-6 text-center text-lg-left">

                                <h4 class="mt-3">Agregar Producto</h4>

                            </div>

                            <div class="col-12 col-lg-6 mt-2 d-none d-lg-block">

                                <!-- <button type="submit" class="btn border-0 templateColor float-right py-2 px-3 btn-sm rounded-pill">Guardar Información</button> -->

                                <a href="/admin/productos" class="btn btn-default float-right py-2 px-3 btn-sm rounded-pill mr-2">Regresar</a>

                            </div>

                            <div class="col-12 text-center d-flex justify-content-center mt-2 d-block d-lg-none">

                                <div>
                                    <a href="/admin/productos" class="btn btn-default py-2 px-3 btn-sm rounded-pill mr-2">Regresar</a>
                                </div>
                                <div>
                                    <!-- <button type="submit" class="btn border-0 templateColor py-2 px-3 btn-sm rounded-pill">Guardar Información</button> -->
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="card-body">

                    <?php

                    require_once "controllers/products.controller.php";
                    $manage = new ProductsController();
                    $manage->productManage();

                    ?>

                    <!--=================================================
                      PRIMER BLOQUE
                     =================================================-->

                    <div class="row row-cols-1 row-cols-md-2">

                        <div class="col">

                            <div class="card">

                                <div class="card-body">

                                    <!--=================================================
                                    Seleccionar la categoria
                                    =================================================-->

                                    <div class="form-group pb-3">

                                        <?php if (!empty($subcategory)): ?>

                                            <input type="hidden" name="old_id_category_subcategory" value="<?php echo base64_encode($subcategory->id_category_subcategory) ?>">

                                        <?php endif ?>

                                        <label for="id_category_product">Seleccionar Categoría<sup class="text-danger">*</sup></label>

                                        <?php


                                        $url = "categories?select=id_category,name_category";
                                        $method = "GET";
                                        $fields = array();

                                        $categories = CurlController::request($url, $method, $fields);

                                        if ($categories->status == 200) {

                                            $categories = $categories->results;
                                        } else {

                                            $categories = array();
                                        }

                                        ?>

                                        <select
                                            class="custom-select"
                                            name="id_category_product"
                                            id="id_category_product"
                                            onchange="changeCategory(event)"
                                            required>

                                            <option value="">Selecciona Categoría</option>

                                            <?php foreach ($categories as $key => $value): ?>

                                                <option value="<?php echo $value->id_category ?>" <?php if (!empty($subcategory) && $subcategory->id_category_subcategory == $value->id_category): ?> selected <?php endif ?>><?php echo $value->name_category ?></option>

                                            <?php endforeach ?>

                                        </select>

                                    </div>

                                    <!--=================================================
                                    Seleccionar la subcategoria
                                    =================================================-->

                                    <div class="form-group pb-3">

                                        <label for="id_subcategory_product">Seleccionar Subcategoría<sup class="text-danger">*</sup></label>

                                        <select
                                            class="custom-select"
                                            name="id_subcategory_product"
                                            id="id_subcategory_product"
                                            required>

                                            <option value="">Selecciona Primero una Categoría</option>

                                        </select>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col">

                            <div class="card">

                                <div class="card-body">

                                    <!--=================================================
                                    Título del Producto
                                    =================================================-->

                                    <div class="form-group pb-3">

                                        <label for="name_product">Título <sup class="text-danger font-weight-bold">*</sup></label>

                                        <input
                                            type="text"
                                            class="form-control"
                                            placeholder="Ingresar el título"
                                            id="name_product"
                                            name="name_product"
                                            onchange="validateDataRepeat(event,'product')"
                                            <?php if (!empty($subcategory)): ?> readonly <?php endif ?>
                                            value="<?php if (!empty($subcategory)): ?><?php echo $subcategory->name_subcategory ?><?php endif ?>"
                                            required>

                                        <div class="valid-feedback">Válido.</div>
                                        <div class="invalid-feedback">Por favor llena este campo correctamente.</div>

                                    </div>
                                    <!--=================================================
                                    URL del Producto
                                    =================================================-->

                                    <div class="form-group pb-3">

                                        <label for="url_product">URL <sup class="text-danger font-weight-bold">*</sup></label>

                                        <input
                                            type="text"
                                            class="form-control"
                                            id="url_product"
                                            name="url_product"
                                            value="<?php if (!empty($subcategory)): ?><?php echo $subcategory->url_subcategory ?><?php endif ?>"
                                            readonly
                                            required>

                                        <div class="valid-feedback">Válido.</div>
                                        <div class="invalid-feedback">Por favor llena este campo correctamente.</div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!--=================================================
                      SEGUNDO BLOQUE
                     =================================================-->

                    <div class="row row-cols-1 row-cols-md-2 pt-2">

                        <div class="col">

                            <div class="card">

                                <div class="card-body">

                                    <!--=================================================
                                    Descripción del producto
                                    =================================================-->

                                    <div class="form-group pb-3">

                                        <label for="description_product">Descripción<sup class="text-danger font-weight-bold">*</sup></label>

                                        <textarea
                                            rows="9"
                                            class="form-control mb-3"
                                            placeholder="Ingresar la descripción"
                                            id="description_product"
                                            name="description_product"
                                            onchange="validateJS(event,'complete')"
                                            required><?php if (!empty($subcategory)): ?><?php echo $subcategory->description_subcategory ?><?php endif ?></textarea>

                                        <div class="valid-feedback">Válido.</div>
                                        <div class="invalid-feedback">Por favor llena este campo correctamente.</div>

                                    </div>

                                    <!--=================================================
                                    Palabras claves del producto
                                    =================================================-->

                                    <div class="form-group pb-3">

                                        <label for="keywords_product">Palabras claves<sup class="text-danger font-weight-bold">*</sup></label>

                                        <input
                                            type="text"
                                            class="form-control tags-input"
                                            data-role="tagsinput"
                                            placeholder="Ingresar las palabras claves"
                                            id="keywords_product"
                                            name="keywords_product"
                                            onchange="validateJS(event,'complete-tags')"
                                            value="<?php if (!empty($subcategory)): ?><?php echo $subcategory->keywords_subcategory ?><?php endif ?>"
                                            required>

                                        <div class="valid-feedback">Válido.</div>
                                        <div class="invalid-feedback">Por favor llena este campo correctamente.</div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col">

                            <div class="card">

                                <div class="card-body">

                                    <!--=================================================
                                Imagen del producto
                                =================================================-->

                                    <div class="form-group pb-3 text-center">

                                        <label class="pb-3 float-left">Imagen del Producto<sup class="text-danger">*</sup></label>

                                        <label for="image_product">

                                            <?php if (!empty($subcategory)): ?>

                                                <input type="hidden" value="<?php echo $subcategory->image_subcategory ?>" name="old_image_product">

                                                <img src="/views/assets/img/products/<?php echo $subcategory->url_subcategory ?>/<?php echo $subcategory->image_subcategory ?>" alt="image default" class="img-fluid chageImage">

                                            <?php else: ?>

                                                <img src="/views/assets/img/products/default/default-image.jpg" alt="image default" class="img-fluid chageImage">

                                            <?php endif ?>


                                            <p class="help-block small mt-3">Dimensiones recomendadas: 1000 x 600 pixeles | Peso Max.
                                                2MB | Formato: PNG o JPG</p>

                                        </label>

                                        <div class="custom-file">

                                            <input
                                                type="file"
                                                class="custom-file-input"
                                                id="image_product"
                                                name="image_product"
                                                accept="image/*"
                                                maxSize="2000000"
                                                onchange="validateImageJS(event, 'chageImage')"
                                                <?php if (empty($subcategory)): ?>
                                                required
                                                <?php endif ?>>

                                            <div class="valid-feedback">Válido.</div>
                                            <div class="invalid-feedback">Por favor llenar este campo correctamente.</div>

                                            <label class="custom-file-label" for="image_subcategory">Buscar Archivo</label>

                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>

                    <!--=================================================
                      TERCER BLOQUE
                     =================================================-->

                    <div class="row row-cols-1 pt-2">

                        <div class="col">

                            <div class="card">

                                <div class="card-body col-md-6 offset-md-3">

                                    <!--=================================================
                                    Visor metadatos
                                    =================================================-->

                                    <div class="form-group pb-3 text-center">

                                        <label>Visor Metadatos</label>

                                        <div class="d-flex justify-content-center">

                                            <div class="card">

                                                <div class="card-body">

                                                    <!--=================================================
                                                Visor imagen
                                                =================================================-->

                                                    <figure class="mb-2">

                                                        <?php if (!empty($subcategory)): ?>

                                                            <img src="/views/assets/img/products/<?php echo $subcategory->url_subcategory ?>/<?php echo $subcategory->image_subcategory ?>" class="img-fluid metaImg" alt="img" style="width:100%">

                                                        <?php else: ?>

                                                            <img src="/views/assets/img/products/default/default-image.jpg" class="img-fluid metaImg" alt="img" style="width:100%">

                                                        <?php endif ?>

                                                    </figure>

                                                    <!--=================================================
                                                    Visor titulos
                                                    =================================================-->

                                                    <h6 class="text-left text-primary mb-1 metaTitle">

                                                        <?php if (!empty($subcategory)): ?>
                                                            <?php echo $subcategory->name_subcategory ?>
                                                        <?php else: ?>
                                                            Lorem Ipsum Dolor Sit
                                                        <?php endif ?>
                                                    </h6>
                                                    <!--=================================================
                                                    Visor URL
                                                    =================================================-->

                                                    <p class="text-left text-success small mb-1">

                                                        <?php echo $path ?><span class="metaURL"><?php if (!empty($subcategory)): ?><?php echo $subcategory->url_subcategory ?><?php else: ?>lorem<?php endif ?></span>

                                                    </p>

                                                    <!--=================================================
                                                    Visor Descripción
                                                    =================================================-->

                                                    <p class="text-left small mb-1 metaDescription">

                                                        <?php if (!empty($subcategory)): ?>
                                                            <?php echo $subcategory->description_subcategory ?>
                                                        <?php else: ?>
                                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since.
                                                        <?php endif ?>

                                                    </p>

                                                    <!--=================================================
                                                    Visor Palabras claves
                                                    =================================================-->

                                                    <p class="small text-left text-secondary metaTags">

                                                        <?php if (!empty($subcategory)): ?>
                                                            <?php echo $subcategory->keywords_subcategory ?>
                                                        <?php else: ?>
                                                            lorem, ipsum, dolor, sit
                                                        <?php endif ?>

                                                    </p>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="card-footer">

                    <div class="container">

                        <div class="row">

                            <div class="col-12 col-lg-6 text-center text-lg-left mt-lg-3">

                                <label class="font-weight-light"><sup class="text-danger">*</sup> Campos obligatorios</label>

                            </div>

                            <div class="col-12 col-lg-6 mt-2 d-none d-lg-block">

                                <button type="submit" class="btn border-0 templateColor float-right py-2 px-3 btn-sm rounded-pill">Guardar Información
                                </button>
                                <!-- <a href="/admin/categorias" class="btn btn-default float-right py-2 px-3 btn-sm rounded-pill mr-2">Regresar</a> -->

                            </div>

                            <div class="col-12 text-center d-flex justify-content-center mt-2 d-block d-lg-none">

                                <div>
                                    <!-- <a href="/admin/categorias" class="btn btn-default py-2 px-3 btn-sm rounded-pill mr-2">Regresar</a> -->
                                </div>
                                <div>
                                    <button type="submit" class="btn border-0 templateColor py-2 px-3 btn-sm rounded-pill">Guardar Información</button>
                                </div>

                            </div>

                        </div>

                    </div>


                </div>


            </form>

        </div>

    </div>

</div>

<!--=================================================
Modal con libreria de iconos
 =================================================-->

<div class="modal" id="myIcon">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Cambiar Icono</h4>
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body mx-3">

                <input type="text" class="form-control mt-4 mb-3 myInpuIcon" placeholder="Buscar Icono">

                <?php

                $data = file_get_contents($path . "views/assets/json/fontawesome.json");
                $icons = json_decode($data);

                ?>

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 py-3"
                    style="overflow-y: scroll; overflow-x: hidden; height:350px">

                    <?php foreach ($icons as $key => $value): ?>

                        <div class="col text-center py-4 btn btnChangeIcon" mode="<?php echo $value ?>">
                            <i class="<?php echo $value ?> fa-2x"></i>
                        </div>

                    <?php endforeach ?>

                </div>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-white btn-sm" data-bs-dismiss="modal">Salir</button>

            </div>

        </div>

    </div>

</div>