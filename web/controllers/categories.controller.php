<?php

class CategoriesController
{

    /*=================================================
    Gestión Categorias
    =================================================*/

    public function categoryManage()
    {

        if (isset($_POST["name_category"])) {

            echo '<script>

                fncMatPreloader("on");
                fncSweetAlert("loading", "", "");

            </script>';

            /*=================================================
            Validar y guardar la información de la categoría
            =================================================*/

            $fields = array(

                "name_category" => trim(TemplateController::capitalize($_POST["name_category"])),
                "url_category" => $_POST["url_category"],
                "icon_category" => $_POST["icon_category"],
                "image_category" => "",
                "description_category" => trim($_POST["description_category"]),
                "keywords_category" => strtolower($_POST["keywords_category"]),
                "date_created_category" => date("Y-m-d")
            );


            $url = "categories?token=" . $_SESSION["admin"]->token_admin . "&table=admins&suffix=admin";
            $method = "POST";

            $createData = CurlController::request($url, $method, $fields);

            if ($createData->status == 200) {

                echo '<script>

                        fncMatPreloader("off");
                        fncFormatInputs();

                        fncSweetAlert("success","Sus datos han sido creados con éxito","/admin/categorias");

                    </script>';

            } else {

                if ($createData->status == 303) {

                    echo '<script>

                            fncFormatInputs();
                            fncMatPreloader("off");
                            fncSweetAlert("error","Token expirado, vuelva a iniciar sesión","/salir");

                         </script>';
                } else {

                    echo '<script>

                            fncFormatInputs();
                            fncMatPreloader("off");
                            fncSweetAlert("error","Ocurrió un error mientras se guardaban los datos, intente de nuevo");

                    </script>';
                }
            }
        }
    }
}
