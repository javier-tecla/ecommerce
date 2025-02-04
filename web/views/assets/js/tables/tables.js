/*=============================================
Tabla para administradores
=============================================*/
if ($(".adminsTable").length > 0) {
  let url = "/ajax/data-admins.ajax.php";
  let columns = [
    { "data": "id_admin" },
    { "data": "name_admin" },
    { "data": "email_admin" },
    { "data": "rol_admin" },
    { "data": "date_updated_admin" },
    { "data": "actions", "orderable": false, "searchable": false }
  ];
  let order = [0, "desc"];
  
  $("#tables").DataTable({
    "responsive": true,
    "aLengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
    "order": [order],
    "lengthChange": true,
    "autoWidth": false,
    "processing": true,
    "serverSide": true,
    "ajax": {
      "url": url,
      "type": "POST"
    },
    "columns": columns,
    "language": {
      "sProcessing": "Procesando...",
      "sLengthMenu": "Mostrar _MENU_ registros",
      "sZeroRecords": "No se encontraron resultados",
      "sEmptyTable": "Ningún dato disponible en esta tabla",
      "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
      "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
      "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix": "",
      "sSearch": "Buscar:",
      "sUrl": "",
      "sInfoThousands": ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
    }
  });
}

/*=============================================
Tabla para categorias
=============================================*/
if ($(".categoriesTable").length > 0) {
  let url = "/ajax/data-categories.ajax.php";
  let columns = [
    { "data": "id_category" },
    { "data": "status_category" },
    { "data": "name_category" },
    { "data": "url_category" },
    { "data": "image_category" },
    { "data": "description_category" },
    { "data": "keywords_category" },
    { "data": "subcategories_category" },
    { "data": "products_category" },
    { "data": "views_category" },
    { "data": "date_updated_category" },
    { "data": "actions", "orderable": false, "searchable": false }
  ];
  let order = [0, "desc"];

  $("#tables").DataTable({
    "responsive": true,
    "aLengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
    "order": [order],
    "lengthChange": true,
    "autoWidth": false,
    "processing": true,
    "serverSide": true,
    "ajax": {
      "url": url,
      "type": "POST"
    },
    "columns": columns,
    "language": {
      "sProcessing": "Procesando...",
      "sLengthMenu": "Mostrar _MENU_ registros",
      "sZeroRecords": "No se encontraron resultados",
      "sEmptyTable": "Ningún dato disponible en esta tabla",
      "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
      "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
      "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix": "",
      "sSearch": "Buscar:",
      "sUrl": "",
      "sInfoThousands": ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
    }
  });
}

/*=============================================
Tabla para subcategorias
=============================================*/
if ($(".subcategoriesTable").length > 0) {
  let url = "/ajax/data-subcategories.ajax.php";
  let columns = [
    { "data": "id_subcategory" },
    { "data": "status_subcategory" },
    { "data": "name_subcategory" },
    { "data": "url_subcategory" },
    { "data": "image_subcategory" },
    { "data": "description_subcategory" },
    { "data": "keywords_subcategory" },
    { "data": "name_category" },
    { "data": "products_subcategory" },
    { "data": "views_subcategory" },
    { "data": "date_updated_subcategory" },
    { "data": "actions", "orderable": false, "searchable": false }
  ];
  let order = [0, "desc"];

  $("#tables").DataTable({
    "responsive": true,
    "aLengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
    "order": [order],
    "lengthChange": true,
    "autoWidth": false,
    "processing": true,
    "serverSide": true,
    "ajax": {
      "url": url,
      "type": "POST"
    },
    "columns": columns,
    "language": {
      "sProcessing": "Procesando...",
      "sLengthMenu": "Mostrar _MENU_ registros",
      "sZeroRecords": "No se encontraron resultados",
      "sEmptyTable": "Ningún dato disponible en esta tabla",
      "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
      "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
      "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix": "",
      "sSearch": "Buscar:",
      "sUrl": "",
      "sInfoThousands": ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
    }
  });
}

/*=============================================
Tabla para productos
=============================================*/
if ($(".productsTable").length > 0) {
  let url = "/ajax/data-products.ajax.php";
  let columns = [
    { "data": "id_product" },
    { "data": "status_product" },
    { "data": "name_product" },
    { "data": "url_product" },
    { "data": "image_product" },
    { "data": "description_product" },
    { "data": "keywords_product" },
    { "data": "name_category" },
    { "data": "name_subcategory" },
    { "data": "views_product" },
    { "data": "date_updated_product" },
    { "data": "actions", "orderable": false, "searchable": false }
  ];
  let order = [0, "desc"];

  $("#tables").DataTable({
    "responsive": true,
    "aLengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
    "order": [order],
    "lengthChange": true,
    "autoWidth": false,
    "processing": true,
    "serverSide": true,
    "ajax": {
      "url": url,
      "type": "POST"
    },
    "columns": columns,
    "language": {
      "sProcessing": "Procesando...",
      "sLengthMenu": "Mostrar _MENU_ registros",
      "sZeroRecords": "No se encontraron resultados",
      "sEmptyTable": "Ningún dato disponible en esta tabla",
      "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
      "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
      "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix": "",
      "sSearch": "Buscar:",
      "sUrl": "",
      "sInfoThousands": ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
    }
  });
}

/*=============================================
Eliminar item
=============================================*/
$(document).on("click", ".deleteItem", function () {
  const idItem = $(this).attr("idItem");
  const table = $(this).attr("table");
  const column = $(this).attr("column");
  const rol = $(this).attr("rol");

  fncSweetAlert("confirm", "¿Está seguro de borrar este item?", "").then(resp => {
    if (resp) {
      fncMatPreloader("on");
      fncSweetAlert("loading", "", "");

      const token = rol === "admin" ? localStorage.getItem("token-admin") : "";
      const url = rol === "admin" ? "/ajax/delete-admin.ajax.php" : "";

      const data = new FormData();
      data.append("token", token);
      data.append("table", table);
      data.append("id", idItem);
      data.append("nameId", "id_" + column);

      $.ajax({
        url: url,
        method: "POST",
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: response => {
          fncMatPreloader("off");
          if (response == 200) {
            fncSweetAlert("success", "El item ha sido borrado correctamente", location.reload());
          } else if (response == "no-borrar") {
            fncToastr("warning", "Este item no se puede borrar");
          } else {
            fncToastr("error", "Este item no se pudo borrar");
          }
        }
      });
    }
  });
});

/*=============================================
Suiche
=============================================*/
$("#tables").on("draw.dt", function () {
  $("input[data-bootstrap-switch]").each(function () {
    $(this).bootstrapSwitch({
      onSwitchChange: function (event, state) {
        const idItem = $(event.target).attr("idItem");
        const table = $(event.target).attr("table");
        const column = $(event.target).attr("column");
        const status = state ? 1 : 0;
        const token = localStorage.getItem("token-admin");

        const data = new FormData();
        data.append("token", token);
        data.append("table", table);
        data.append("id", idItem);
        data.append("status", status);
        data.append("column", column);

        $.ajax({
          url: "/ajax/status-admin.ajax.php",
          method: "POST",
          data: data,
          contentType: false,
          cache: false,
          processData: false,
          success: response => {
            fncMatPreloader("off");
            if (response == 200) {
              fncToastr("success", "El item ha sido actualizado correctamente");
            } else {
              fncToastr("error", "Este item no se pudo actualizar");
            }
          }
        });
      }
    });
  });
});