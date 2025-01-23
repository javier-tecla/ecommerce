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

            $url = "categories?select=id_category";
            $method = "GET";
            $fields = array();

            $response = CurlController::request($url, $method, $fields);

            if ($response->status == 200) {

                $totalData = $response->total;
            } else {

                echo '{
                    "Draw": 1,
                    "recordsTotal": 0,
                    "recordsFiltered": 0,
                    "data":[]}';

                return;
            }

            $select = "*";


            /*=============================================
           	Búsqueda de datos
            =============================================*/

            if (!empty($_POST['search']['value'])) {

                if (preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/', $_POST['search']['value'])) {

                    $linkTo = ["name_category", "url_category", "description_category", "keywords_category", "date_updated_category"];

                    $search = str_replace(" ", "_", $_POST['search']['value']);

                    foreach ($linkTo as $key => $value) {

                        $url = "categories?select=" . $select . "&linkTo=" . $value . "&search=" . $search . "&orderBy=" . $orderBy . "&orderMode=" . $orderType . "&startAt=" . $start . "&endAt=" . $length;

                        $data = CurlController::request($url, $method, $fields)->results;

                        if ($data == "Not Found") {

                            $data = array();
                            $recordsFiltered = 0;
                        } else {

                            $recordsFiltered = count($data);
                            break;
                        }
                    }
                } else {

                    echo '{
                        "Draw": 1,
                        "recordsTotal": 0,
                        "recordsFiltered": 0,
                        "data":[]}';
    
                    return;
                }
            } else {

                /*=============================================
	            Seleccionar datos
	            =============================================*/

                $url = "categories?select=" . $select . "&orderBy=" . $orderBy . "&orderMode=" . $orderType . "&startAt=" . $start . "&endAt=" . $length;
                $data = CurlController::request($url, $method, $fields)->results;

                $recordsFiltered = $totalData;
            }

            /*=================================================
            Cuando la data viene vacía
            =================================================*/

            if (empty($data)) {

                echo '{
                    "Draw": 1,
                    "recordsTotal": 0,
                    "recordsFiltered": 0,
                    "data":[]}';

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

                  /*=================================================
                    SATATUS
                   =================================================*/

                   $status_category = $value->status_category;

                   /*=================================================
                    TEXTOS
                   =================================================*/

                $name_category = $value->name_category;
                $url_category = $value->url_category;
                $image_category = $value->image_category;
                $description_category = $value->description_category;
                $keywords_category = $value->keywords_category;
                $subcategories_category = $value->subcategories_category;
                $products_category = $value->products_category;
                $views_category = $value->views_category;
                $date_updated_category = $value->date_updated_category;

                $actions = "<div class='btn-group'>
									<a href='/admin/categorias/gestion?admin=" . base64_encode($value->id_category) . "' class='btn bg-purple border-0 rounded-pill mr-2 btn-sm px-3'>
										<i class='fas fa-pencil-alt text-white'></i>
									</a>
									<button class='btn btn-dark border-0 rounded-pill mr-2 btn-sm px-3 deleteItem' rol='admin' table='categories' column='category' idItem='" . base64_encode($value->id_category) . "'>
										<i class='fas fa-trash-alt text-white'></i>
									</button>
								</div>";

                $actions = TemplateController::htmlClean($actions);

                $dataJson .= '{ 
                        "id_category":"' . ($start + $key + 1) . '",
                        "status_category":"' . $status_category . '",
                        "name_category":"' . $name_category . '",
                        "url_category":"' . $url_category . '",
                        "image_category":"' . $image_category . '",  
                        "description_category":"' . $description_category . '",  
                        "keywords_category":"' . $keywords_category . '",  
                        "subcategories_category":"' . $subcategories_category . '",  
                        "products_category":"' . $products_category . '",  
                        "views_category":"' . $views_category . '",  
                        "date_updated_category":"' . $date_updated_category . '" ,
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
