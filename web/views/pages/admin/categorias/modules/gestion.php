<div class="content">

    <div class="container">

        <div class="card">

            <form method="post" class="needs-validation" novalidate>

                <div class="card-header">

                    <div class="container">

                        <div class="row">

                            <div class="col-12 col-lg-6 text-center text-lg-left">

                                <h4 class="mt-3">Agregar Categoría</h4>

                            </div>

                            <div class="col-12 col-lg-6 mt-2 d-none d-lg-block">

                                <!-- <button type="submit" class="btn border-0 templateColor float-right py-2 px-3 btn-sm rounded-pill">Guardar Información</button> -->

                                <a href="/admin/categorias" class="btn btn-default float-right py-2 px-3 btn-sm rounded-pill mr-2">Regresar</a>

                            </div>

                            <div class="col-12 text-center d-flex justify-content-center mt-2 d-block d-lg-none">

                                <div>
                                    <a href="/admin/categorias" class="btn btn-default py-2 px-3 btn-sm rounded-pill mr-2">Regresar</a>
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

                    require_once "controllers/categories.controller.php";
                    $manage = new CategoriesController();
                    $manage->categoryManage();

                    ?>

                    <!--=================================================
                      PRIMER BLOQUE
                     =================================================-->

                    <div class="row row-cols-1">

                        <div class="col">

                            <div class="card">

                                <div class="card-body">

                                    <!--=================================================
                                    Título de la Categoría
                                    =================================================-->

                                    <div class="form-group pb-3">

                                        <label for="name_category">Título<sup class="text-danger font-weight-bold">*</sup></label>

                                        <input
                                            type="text"
                                            class="form-control"
                                            placeholder="Ingresar el título"
                                            id="name_category"
                                            name="name_category"
                                            onchange="validateDataRepeat(event,'category')"
                                            required>

                                        <div class="valid-feedback">Válido.</div>
                                        <div class="invalid-feedback">Por favor llenar este campo correctamente.</div>

                                    </div>

                                    <!--=================================================
                                    URL de la Categoría
                                    =================================================-->

                                    <div class="form-group pb-3">

                                        <label for="url_category">URL<sup class="text-danger font-weight-bold">*</sup></label>

                                            <input
                                                type="text"
                                                class="form-control"
                                                id="url_category"
                                                name="url_category"
                                                readonly
                                                required
                                            >

                                        <div class="valid-feedback">Válido.</div>
                                        <div class="invalid-feedback">Por favor llenar este campo correctamente.</div>

                                    </div>

                                    <!--=================================================
                                    Icono de la Categoría
                                    =================================================-->

                                    <div class="form-group pb-3">

                                        <label for="icon_category">Icono<sup class="text-danger font-weight-bold">*</sup></label>

                                        <div class="input-group">

                                            <span class="input-group-text">

                                                <i class="fas fa-shopping-bag"></i>

                                            </span>

                                            <input
                                                type="text"
                                                class="form-control"
                                                id="icon_category"
                                                name="icon_category"
                                                required>

                                            <div class="valid-feedback">Válido.</div>
                                            <div class="invalid-feedback">Por favor llenar este campo correctamente.</div>

                                        </div>

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
                                    Descripción de la categoría
                                    =================================================-->

                                    <div class="form-group pb-3">

                                        <label for="description_category">Descripción<sup class="text-danger fint-weight-bold">*</sup></label>

                                        <textarea
                                            rows="9"
                                            class="form-control mb-3"
                                            placeholder="Ingresar la descripción"
                                            id="description_category"
                                            name="description_category"
                                            required></textarea>

                                        <div class="valid-feedback">Válido.</div>
                                        <div class="invalid-feedback">Por favor llenar este campo correctamente.</div>

                                    </div>

                                    <!--=================================================
                                    Palabras claves de la categoría
                                    =================================================-->

                                    <div class="form-group pb-3">

                                        <label for="keywords_category">Palabras claves<sup class="text-danger fint-weight-bold">*</sup></label>

                                        <input
                                            type="text"
                                            class="form-control tags-input"
                                            placeholder="Ingresar las palabras claves"
                                            id="keywords_category"
                                            name="keywords_category"
                                            required>

                                        <div class="valid-feedback">Válido.</div>
                                        <div class="invalid-feedback">Por favor llenar este campo correctamente.</div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col">

                            <div class="card">

                                <div class="card-body">

                                    <!--=================================================
                                Imagen de la categoría
                                =================================================-->

                                    <div class="form-group pb-3 text-center">

                                        <label class="pb-3 float-left">Imagen de la categoría<sup class="text-danger">*</sup></label>

                                        <label for="image_category">

                                            <img src="/views/assets/img/categories/default/default-image.jpg" alt="image default" class="img-fluid">

                                            <p class="help-block small mt-3">Dimensiones recomendadas: 1000 x 600 pixeles | Peso Max.
                                                2MB | Formato: PNG o JPG</p>

                                        </label>

                                        <div class="custom-file">

                                            <input
                                                type="file"
                                                class="custom-file-input"
                                                id="image_category"
                                                name="image_category"
                                                accept="image/*"
                                                maxSize="2000000"
                                                required>

                                            <div class="valid-feedback">Válido.</div>
                                            <div class="invalid-feedback">Por favor llenar este campo correctamente.</div>

                                            <label class="custom-file-label" for="image_category">Buscar Archivo</label>

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