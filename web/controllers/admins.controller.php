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

            if (preg_match('/^[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,}$/', $_POST["loginAdminEmail"])) {



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
                        // fncMatPreloader("off")
                        fncFormatInputs();

                    </script>
                    
                    ';
                }
            } else {

                $error = null;

                echo '<div class="alert alert-danger mt-3">Error de sintaxis en los campos</div>
                    
                    <script>

                        // fncNotie("success", "Error al ingresar: ' . $error . '")
                        // fncSweetAlert("error", "Error al ingresar: ' . $error . '", "");
                        fncToastr("error", "Error de sintaxis en los campos");
                        fncMatPreloader("off")
                        fncFormatInputs();

                    </script>
                    
                    ';
            }
        }
    }

    /*=================================================
Recuperar contraseña
=================================================*/

    public function resetPassword()
    {

        if (isset($_POST["resetPassword"])) {

            /*=================================================
        Validamos la sintaxis de los campos
        =================================================*/

            if (preg_match('/^[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,}$/', $_POST["resetPassword"])) {

                /*=================================================
            Preguntamos primero si el usuario está registrado
            ===================================================*/

                $url = "admins?linkTo=email_admin&equalTo=" . $_POST["resetPassword"] . "&select=id_admin";
                $method = "GET";
                $fields = array();

                $admin = CurlController::request($url, $method, $fields);
                
                if($admin->status == 200){

                    function genPassword($length){

                        $password = "";
                        $chain = "0123456789abcdefghijklmnopqrstuvwxyz";

                        $password = substr(str_shuffle($chain),0,$length);

                        return $password;

                    }

                    $newPassword = genPassword(11);

                    $crypt = crypt($newPassword, '$2a$07$azybxcags23425sdg23sdfhsd$');
                    
                    /*=================================================
                    Actualizar contraseña en base de datos
                     ===================================================*/

                     $url = "admins?id=".$admin->results[0]->id_admin."&nameId=id_admin&token=no&except=password_admin";
                     $method = "PUT";
                     $fields = "password_admin=".$crypt;

                     $updatePassword = CurlController::request($url,$method,$fields);

                     if($updatePassword->status == 200) {

                        echo '<pre>'; print_r($newPassword); echo '</pre>';
                        echo '<pre>'; print_r($crypt); echo '</pre>';
                     }

                }else{

                    echo '<script> 
                    
                        fncFormatInputs();
                        fncNotie("error", "El correo no esta registrado");                 
                    
                    </script>';

                }
            }
        }
    }
}
