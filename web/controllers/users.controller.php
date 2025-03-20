<?php

class UsersController
{

    /*============================================
        Registro de usuarios
        =============================================*/

    public function register()
    {

        if (isset($_POST["email_user"])) {

            echo '<script>
    
                    fncMatPreloader("on");
                    fncSweetAlert("loading", "procesando...", "");
    
                </script>';

            if (
                preg_match('/^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["name_user"]) &&
                preg_match('/^[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["email_user"])
            ) {

                /*=============================================
                    Registro de Usuarios
                    =============================================*/
                $confirm_user = TemplateController::genPassword(20);

                $url = "users?register=true&suffix=user";
                $method = "POST";
                $fields = array(
                    "name_user" => TemplateController::capitalize(trim($_POST["name_user"])),
                    "email_user"  => $_POST["email_user"],
                    "password_user" => $_POST["password_user"],
                    "method_user" => "directo",
                    "verification_user" => 0,
                    "confirm_user" => $confirm_user,
                    "date_created_user" => date("Y-m-d")
                );

                $register = CurlController::request($url, $method, $fields);

                if ($register->status == 200) {

                    /*=============================================
                        Enviamos correo de confirmación
                        =============================================*/
                    $subject = 'Registro - Ecommerce';
                    $email = $_POST["email_user"];
                    $title = 'CONFIRMAR CORREO ELECTRÓNICO';
                    $message = '<h4 style="font-weight: 100; color:#999; padding:0px 20px">Dar clic en el siguiente botón para confirmar su correo electrónico y activar su cuenta</h4>';
                    $link = TemplateController::path() . '?confirm=' . $confirm_user;

                    $sendEmail = TemplateController::sendEmail($subject, $email, $title, $message, $link);

                    if ($sendEmail == "ok") {

                        echo '<script>
    
                                    fncFormatInputs();
                                    fncMatPreloader("off");
                                    fncToastr("success", "Su cuenta ha sido creada, revisa tu correo electrónico para activar tu cuenta");
    
                                </script>
                            ';
                    } else {

                        echo '<script>
    
                                fncFormatInputs();
                                fncMatPreloader("off");
                                fncNotie("error", "' . $sendEmail . '");
    
                                </script>
                            ';
                    }
                }
            } else {

                echo '<div class="alert alert-danger mt-3">Error de sintaxis en los campos</div>
    
                    <script>
    
                        fncToastr("error","Error de sintaxis en los campos");
                        fncMatPreloader("off");
                        fncFormatInputs();
    
                    </script>
    
                    ';
            }
        }
    }

    /*============================================
        Ingreso de usuarios
        =============================================*/

    public function login()
    {

        if (isset($_POST["login_email_user"])) {

            echo '<script>

                fncMatPreloader("on");
                fncSweetAlert("loading", "procesando...", "");
            
            </script>';

            if (preg_match('/^[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,}$/', $_POST["login_email_user"])) {

                $url = "users?login=true&suffix=user";
                $method = "POST";
                $fields = array(

                    "email_user" => $_POST["login_email_user"],
                    "password_user" => $_POST["login_password_user"]

                );

                $login = CurlController::request($url, $method, $fields);

                if ($login->status == 200) {

                    $_SESSION["user"] = $login->results[0];

                    echo '<script>
                
                    localStorage.setItem("token-user", "' . $login->results[0]->token_user . '")
                    window.location="' . TemplateController::urlRedirect() . '";

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

                    fncToastr("error","Error al ingresar: ' . $error . '");
                        fncMatPreloader("off");
                        fncFormatInputs();

                    </script>';
                }
            }
        }
    }

    /*============================================
        Volver a enviar Verificación de usuario
        =============================================*/

        public function verification(){

            if(isset($_POST["new_verification"]) && $_POST["new_verification"] == "yes"){
    
                echo '<script>
    
                    fncMatPreloader("on");
                    fncSweetAlert("loading", "procesando...", "");
    
                </script>';
    
                $confirm_user = TemplateController::genPassword(20);
    
                $url = "users?id=".$_SESSION["user"]->id_user."&nameId=id_user&token=".$_SESSION["user"]->token_user."&table=users&suffix=user";
                $method = "PUT";
                $fields = "confirm_user=".$confirm_user;
                
                $verification = CurlController::request($url, $method, $fields);
    
                if($verification->status == 200){
    
                    /*=============================================
                    Enviamos correo de confirmación
                    =============================================*/	
                    $subject =  'Verificación - Ecommerce';
                    $email = $_SESSION["user"]->email_user;
                    $title ='CONFIRMAR CORREO ELECTRÓNICO';
                    $message = '<h4 style="font-weight: 100; color:#999; padding:0px 20px">Dar clic en el siguiente botón para confirmar su correo electrónico y activar su cuenta</h4>';
                    $link = TemplateController::path().'?confirm='.$confirm_user;
    
                    $sendEmail = TemplateController::sendEmail($subject, $email, $title, $message, $link);
    
                    if($sendEmail == "ok"){
    
                        echo '<script>
    
                                fncFormatInputs();
                                fncMatPreloader("off");
                                fncToastr("success", "Se ha enviado nuevamente un correo electrónico para activar su cuenta");
    
                            </script>
                        ';
    
                    }else{
    
                        echo '<script>
    
                            fncFormatInputs();
                            fncMatPreloader("off");
                            fncNotie("error", "'.$sendEmail.'");
    
                            </script>
                        ';
    
                    }
    
    
    
                }
    
    
            }
        }

        /*=============================================
	Modificar datos de usuarios
	=============================================*/	

	public function modify(){

		if(isset($_POST["country_user"])){

			echo '<script>

				fncMatPreloader("on");
				fncSweetAlert("loading", "procesando...", "");

			</script>';

			$password_user;

			if(!empty($_POST["password_user"])){

				$password_user = crypt($_POST["password_user"], '$2a$07$azybxcags23425sdg23sdfhsd$');

				$fields = "name_user=".TemplateController::capitalize(trim($_POST["name_user"]))."&password_user=".$password_user."&country_user=".explode("_",$_POST["country_user"])[0]."&department_user=".TemplateController::capitalize(trim($_POST["department_user"]))."&city_user=".TemplateController::capitalize(trim($_POST["city_user"]))."&address_user=".trim(urlencode($_POST["address_user"]))."&phone_user=".str_replace("+","",explode("_",$_POST["country_user"])[1])."_".str_replace("-","",$_POST["phone_user"]);

			}else{

				$fields = "name_user=".TemplateController::capitalize(trim($_POST["name_user"]))."&country_user=".explode("_",$_POST["country_user"])[0]."&department_user=".TemplateController::capitalize(trim($_POST["department_user"]))."&city_user=".TemplateController::capitalize(trim($_POST["city_user"]))."&address_user=".trim(urlencode($_POST["address_user"]))."&phone_user=".str_replace("+","",explode("_",$_POST["country_user"])[1])."_".str_replace("-","",$_POST["phone_user"]);
				
			}

			$url = "users?id=".$_SESSION["user"]->id_user."&nameId=id_user&token=".$_SESSION["user"]->token_user."&table=users&suffix=user";
			$method = "PUT";
			
			$modify = CurlController::request($url, $method, $fields);

			if($modify->status == 200){

				$_SESSION["user"]->name_user = TemplateController::capitalize(trim($_POST["name_user"]));
				$_SESSION["user"]->country_user = explode("_",$_POST["country_user"])[0];
				$_SESSION["user"]->department_user = TemplateController::capitalize(trim($_POST["department_user"]));
				$_SESSION["user"]->city_user = TemplateController::capitalize(trim($_POST["city_user"]));
				$_SESSION["user"]->address_user = trim($_POST["address_user"]);
				$_SESSION["user"]->phone_user = str_replace("+","",explode("_",$_POST["country_user"])[1])."_".str_replace("-","",$_POST["phone_user"]);

				echo '<script>

						fncFormatInputs();
						fncMatPreloader("off");
						fncToastr("success", "Se han actualizado tus datos");

					</script>
				';

			}



		}

	}
}
