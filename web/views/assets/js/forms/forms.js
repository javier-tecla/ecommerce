/*===========================================
Validación Bootstrap 5
=============================================*/
// Disable form submissions if there are invalid fields
(function () {
  'use strict';
  window.addEventListener('load', function () {
    // Get the forms we want to add validation styles to
    let forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    let validation = Array.prototype.filter.call(forms, function (form) {
      form.addEventListener('submit', function (event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();

/*===========================================
Función para validar datos repetidos
=============================================*/

function validateDataRepeat(event, type) {
  const value = event.target.value;

  let table;
  let linkTo;

  if (type === "category") {
    table = "categories";
    linkTo = "name_category";
  } else if (type === "subcategory") {
    table = "subcategories";
    linkTo = "name_subcategory";
  } else if (type === "product") {
    table = "products";
    linkTo = "name_product";
  } else {
    console.error("Invalid type provided");
    return; // Salir si el tipo no es válido
  }

  const data = new FormData();
  data.append("table", table);
  data.append("equalTo", value);
  data.append("linkTo", linkTo);

  $.ajax({
    url: "/ajax/forms.ajax.php",
    method: "POST",
    data: data,
    contentType: false,
    cache: false,
    processData: false,
    success: function (response) {

      if (response == 404) {

        validateJS(event, "complete");

        createUrl(event, "url_"+type);

        $(".metaTitle").html(value);

      } else {

        $(event.target).parent().addClass("was-validated");
        $(event.target).parent().children(".invalid-feedback").html("El nombre ya existe en la base de datos")

        event.target.value = "";

        return;

      }
    },
  });
}

/*===========================================
Función para crear Url's
=============================================*/

function createUrl(event, input) {

  let value = event.target.value;

  value = value.toLowerCase();
  value = value.replace(/[#\\;\\$\\&\\%\\=\\(\\)\\:\\,\\'\\"\\.\\¿\\¡\\!\\?]/g, "");
  value = value.replace(/[ ]/g, "-");
  value = value.replace(/[á]/g, "a");
  value = value.replace(/[é]/g, "e");
  value = value.replace(/[í]/g, "i");
  value = value.replace(/[ó]/g, "o");
  value = value.replace(/[ú]/g, "u");
  value = value.replace(/[ñ]/g, "n");

  $('[name="' + input + '"]').val(value);
  $('.metaUrl').html(value);
}


/*===========================================
Función para validar formularios
=============================================*/

function validateJS(event, type) {

  $(event.target).parent().addClass("was-validated");

  if (type == "email") {

    let pattern = /^[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/;

    if (!pattern.test(event.target.value)) {

      $(event.target).parent().children(".invalid-feedback").html("El correo electrónico está mal escrito");

      event.target.value = "";

      return;
    }

  }

  if (type == "text") {

    let pattern = /^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$/;

    if (!pattern.test(event.target.value)) {

      $(event.target).parent().children(".invalid-feedback").html("El campo solo debe llevar texto");

      event.target.value = "";

      return;
    }

  }

  if (type == "password") {

    let pattern = /^[*\\$\\!\\¡\\?\\.\\_\\#\\-\\0-9A-Za-z]{1,}$/;

    if (!pattern.test(event.target.value)) {

      $(event.target).parent().children(".invalid-feedback").html("La contraseña no puede llevar ciertos caracteres especiales");

      event.target.value = "";

      return;
    }

  }

  if (type == "complete") {

    let pattern = /^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\'\\#\\?\\¿\\!\\¡\\:\\,\\.\\/\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}$/;

    if (!pattern.test(event.target.value)) {

      $(event.target).parent().children(".invalid-feedback").html("La entrada tiene errores de caracteres especiales");

      event.target.value = "";

      return;

    } else {

      $(".metaDescription").html(event.target.value)

    }

  }

  if (type == "complete-tags") {

    let pattern = /^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\'\\#\\?\\¿\\!\\¡\\:\\,\\.\\/\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}$/;

    if (!pattern.test(event.target.value)) {

      $(event.target).parent().children(".invalid-feedback").html("La entrada tiene errores de caracteres especiales");

      event.target.value = "";

      return;

    } else {

      $(".metaTags").html(event.target.value)

    }

  }
}

/*===========================================
Función para recordar email en el login
=============================================*/

function rememberEmail(event) {

  if (event.target.checked) {

    localStorage.setItem("emailAdmin", $('[name="loginAdminEmail"]').val());
    localStorage.setItem("checkRem", true);

  } else {

    localStorage.removeItem("emailAdmin");
    localStorage.removeItem("checkRem");
  }
}

function getEmail() {

  if (localStorage.getItem("emailAdmin") != null) {

    $('[name="loginAdminEmail"]').val(localStorage.getItem("emailAdmin"));

  }

  if (localStorage.getItem("checkRem") != null && localStorage.getItem("checkRem")) {

    $("#remember").attr("checked", true);
  }
}

getEmail();

/*===========================================
Cambio de icono para la categoria
=============================================*/

function addIcon(event) {

  $("#myIcon").show();

  $(document).ready(function () {

    $(".myInpuIcon").on("keyup", function () {

      let value = $(this).val().toLowerCase();

      $(".btnChangeIcon").filter(function () {

        $(this).toggle($(this).attr("mode").toLowerCase().indexOf(value) > -1)
      })
    })
  })

  $(document).on("click", ".btnChangeIcon", function (e) {

    e.preventDefault();

    $(".iconView").html(`<i class="` + $(this).attr("mode") + `"></i>`)
    $(event.target).val($(this).attr("mode"))
    $("#myIcon").hide();

  })
}

$(document).on("click", '[data-bs-dismiss="modal"]', function () {

  let modal = $(".modal");

  modal.each((i) => {

    $(modal[i]).hide()

  })
})

/*===========================================
Tags Input
=============================================*/

if ($('.tags-input').length > 0) {

  $('.tags-input').tagsinput({
    maxTags: 5
  });

}

/*===========================================
Validamos imagen
=============================================*/

function validateImageJS(event, tagImg) {

  fncSweetAlert("loading", "", "");

  let image = event.target.files[0];

  if (image == undefined) {

    fncSweetAlert("close", "", "");

    return;

  }

  /*===========================================
  Validamos el formato
  =============================================*/

  if (image["type"] !== "image/jpeg" && image["type"] !== "image/png" && image["type"] !== "image/gif") {

    fncSweetAlert("error", "La imagen debe estar en formato JPG, GIF o PNG.", null)

    return;

  }

  /*===========================================
  Validamos el tamaño
  =============================================*/

  else if (image["size"] > 2000000) {

    fncSweetAlert("error", "La imagen no debe ser superior a 2MB", null)

    return;

  }

  /*===========================================
  Mostramos la imagen temporal
  =============================================*/

  else {

    let data = new FileReader();
    data.readAsDataURL(image);

    $(data).on("load", function (event) {

      let path = event.target.result;

      fncSweetAlert("close", "", "");

      $("." + tagImg).attr("src", path);
      $(".metaImg").attr("src", path);
    })
  }

}

/*===========================================================
  Traer subcategorias de acuerdo a la categoria seleccionada
  ==========================================================*/

function changeCategory(event) {

  $("#id_subcategory_product").html(`<option value="">Selecciona Subcategoría</option>`);

  let idCategory = event.target.value;

  let data = new FormData();
  data.append("idCategory", idCategory);

  $.ajax({
    url: "/ajax/forms.ajax.php",
    method: "POST",
    data: data,
    contentType: false,
    cache: false,
    processData: false,
    success: function (response) {

      if (JSON.parse(response).length > 0) {

        JSON.parse(response).forEach((v) => {

          $("#id_subcategory_product").append(`
            
            <option value="`+ v.id_subcategory + `">` + v.name_subcategory + `</option>

            `)
        })

      }

    }

  })
}


