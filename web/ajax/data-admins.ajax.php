<?php

require_once "../controllers/curl.controller.php";
require_once "../controllers/template.controller.php";

class DataTableController
{

    public function data()
    {

        if (!empty($_POST)) {

            /*===============================================
            Capturando y organizando las variables POST de DT
            =================================================*/

            $draw = $_POST["draw"]; //Contador utilizado por DataTables para garantizar que los retornos de Ajax de las solicitudes de procesamiento del lado del servidor sean dibujados en secuencia por DataTables
            //echo '<pre>'; print_r($draw); echo '</pre>';

            $orderByColumnIndex = $_POST["order"][0]["column"]; //Índice de la columna de clasificación (0 basado en el índice, es decir, 0 es el primer registro)
            //echo '<pre>'; print_r($orderByColumnIndex); echo '</pre>';

            $orderBy = $_POST["columns"][$orderByColumnIndex]["data"]; //Obtener el nombre de la columna de clasificación de su índice
            //echo '<pre>'; print_r($orderBy); echo '</pre>';

            $orderType = $_POST["order"][0]["dir"]; // Obtener el orden ASC o DESC
            //echo '<pre>'; print_r($orderType); echo '</pre>';

            $start = $_POST["start"]; //Indicador de primer registro de paginación.
            //echo '<pre>'; print_r($start); echo '</pre>';

            $length = $_POST["length"]; //Indicador de la longitud de la paginación.
            //echo '<pre>'; print_r($length); echo '</pre>';


            /*=================================================
            El total de registro de la data
            =================================================*/

            $url = "admins?select=id_admin";
            $method = "GET";
            $fields = array();

            $response = CurlController::request($url, $method, $fields);

            if ($response->status == 200) {

                $totalData = $response->total;
            } else {

                echo '{"data":[]}';

                return;
            }

            $select = "id_admin,rol_admin,name_admin,email_admin,date_updated_admin";

            /*=================================================
            Seleccionar datos
            =================================================*/

            $url = "admins?select=" . $select . "&orderBy=" . $orderBy . "&orderMode=" . $orderType . "&startAt=" . $start . "&endAt=" . $length;
            $data = CurlController::request($url, $method, $fields)->results;

            $recordsFiltered = $totalData;


            /*=================================================
            Cuando la data viene vacía
            =================================================*/

            if (empty($data)) {

                echo '{"data": []}';

                return;
            }

            /*=================================================
            Construimos el dato JSON a regresar
            =================================================*/

            $dataJson = '{
                "Draw": ' . intval($draw) . ',
                "recordsTotal": ' . $totalData . ',
                "recordsFiltered": ' . $recordsFiltered . ',
                "data": [';

            foreach ($data as $key => $value) {

                $name_admin = $value->name_admin;
                $email_admin = $value->email_admin;
                $rol_admin = $value->rol_admin;
                $date_updated_admin = $value->date_updated_admin;

                $actions = "<div class='btn-group'>
                                    <a href='' class='btn bg-purple border-0 rounded-pill mr-2 btn-sm px-3'>
                                        <i class='fas fa-pencil-alt text-white'></i>
                                    </a>
                                    <a href='' class='btn bg-dark border-0 rounded-pill mr-2 btn-sm px-3'>
                                        <i class='fas fa-trash-alt text-white'></i>
                                    </a>
                                </div>";

                $actions = TemplateController::htmlClean($actions);          

                $dataJson .= '{ 
                        "id_admin":"' . ($start + $key + 1) . '",
                        "name_admin":"' . $name_admin . '",
                        "email_admin":"' . $email_admin . '",
                        "rol_admin":"' . $rol_admin . '",  
                        "date_updated_admin":"' . $date_updated_admin . '" ,
                        "actions":"' . $actions . '"             
                    },';
            }

            $dataJson = substr($dataJson, 0, -1); // este substr quita el último caracter de la cadena, que es una coma, para impedir que rompa la tabla

            $dataJson  .= ']}';

            echo $dataJson;
        }
    }
}

/*=================================================
 Activar función DataTable
 =================================================*/

$data = new DataTableController();
$data->data();
