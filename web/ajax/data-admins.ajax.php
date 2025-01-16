<?php

class DataTableController
{

    public function data() {

        if(!empty($_POST)){

            $draw = $_POST["draw"]; //Contador utilizado por DataTables para garantizar que los retornos de Ajax de las solicitudes de procesamiento del lado del servidor sean dibujados en secuencia por DataTables
            //echo '<pre>'; print_r($draw); echo '</pre>';

            $orderByColumnIndex = $_POST["order"][0]["column"]; //Índice de la columna de clasificación (0 basado en el índice, es decir, 0 es el primer registro)
            //echo '<pre>'; print_r($orderByColumnIndex); echo '</pre>';

            $orderBy = $_POST["columns"][$orderByColumnIndex]["data"];//Obtener el nombre de la columna de clasificación de su índice
            //echo '<pre>'; print_r($orderBy); echo '</pre>';

            $orderType = $_POST["order"][0]["dir"]; // Obtener el orden ASC o DESC
            //echo '<pre>'; print_r($orderType); echo '</pre>';

            $start = $_POST["start"];//Indicador de primer registro de paginación.
            //echo '<pre>'; print_r($start); echo '</pre>';

            $length = $_POST["length"];//Indicador de la longitud de la paginación.
            //echo '<pre>'; print_r($length); echo '</pre>';

            
            
        }

    }
}

/*=================================================
 Activar función DataTable
 =================================================*/

 $data = new DataTableController();
 $data -> data();