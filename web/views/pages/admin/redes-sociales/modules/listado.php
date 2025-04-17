<div class="content pb-5">

    <div class="container">

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">
                    <button type="button" class="btn bg-dafault templateColor py-2 px-3 btn-sm rounded-pill" data-bs-toggle="modal" data-bs-target="#mySocial">Agregar Red Social</button>
                </h3>

            </div>

            <div class="card-body">

                <table id="tablesStatic" class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Url</th>
                            <th>Icono</th>
                            <th>Color</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($socials as $key => $value): ?>

                            <tr>
                                <td><?php echo $key+1 ?></td>

                                <td>
                                    <p class="text-uppercase"><?php echo $value->name_social ?></p>
                                </td>

                                <td>
                                    <a href="<?php echo $value->url_social ?>" target="_blank"><?php echo $value->url_social ?><i class="fas fa-external-link-alt ml-1"></i></a>
                                </td>

                                <td>
                                    <span class="badge badge-light border rounded-pill text-white py-2 px-3" style="background:<?php echo $topColor->background ?>"><i class="<?php echo $value->icon_social ?> <?php echo $value->color_social ?>"></i></span>
                                </td>

                                <td>
                                    <h3 class="border <?php echo $value->color_social ?> rounded p-0 m-0 text-center" style="width:31px; height:31px"><i class="fas fa-square p-0"></i></h3>
                                </td>

                                <td>
                                    <div class="btn-group">
                                        <button href="" class="btn bg-purple border-0 rounded-pill mr-2 btn-sm px-3 modalEditSocial" data-social='<?php echo json_encode($value) ?>'>
                                            <i class="fas fa-pencil-alt text-white"></i>
                                        </button>
                                        <button href="" class="btn btn-dark border-0 rounded-pill mr-2 btn-sm px-3 deleteItem" rol="admin" table="socials" column="social" idItem="<?php echo base64_encode($value->id_social) ?>">
                                            <i class="fas fa-trash-alt text-white"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>



                        <?php endforeach ?>




                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

