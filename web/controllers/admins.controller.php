<?php


class AdminsController
{

    /*=================================================
Login de administradores
=================================================*/

    public function login()
    {

        if (isset($_POST["loginAdminEmail"])) {

            echo '<script>

                fncMatPreloader("on");
                fncSweetAlert("loading", "", "");
            
            </script>';

            $url = "admins?login=true&suffix=admin";
            $method = "POST";
            $fields = array(

                "email_admin" => $_POST["loginAdminEmail"],
                "password_admin" => $_POST["loginAdminPass"]

            );

            $login = CurlController::request($url, $method, $fields);

            if ($login->status == 200) {

                $_SESSION["admin"] = $login->results[0];

                echo '<script>
            
                location.reload();

                </script>';
            } else {

                $error = null;

                if ($login->results == "Wrong email") {

                    $error = "Correo mal escrito";
                } else {

                    $error = "Contraseña mal escrita";
                }

                echo '<div class="alert alert-danger mt-3">Error al ingresar: ' . $error . '</div>
                
                <script>

                    // fncNotie("success", "Error al ingresar: ' . $error . '")
                    // fncSweetAlert("error", "Error al ingresar: ' . $error . '","");
                    fncToastr("error", "Error al ingresar: ' . $error . '","");
                    fncMatPreloader("off")
                    fncFormatInputs();

                </script>
                
                ';
            }
        }
    }
}
