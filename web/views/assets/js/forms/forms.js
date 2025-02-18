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

        createUrl(event, "url_" + type);

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
  $('.metaURL').html(value);
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

/*=============================================
Summernote
=============================================*/

if ($('.summernote').length > 0) {

  $('.summernote').summernote({

    minHeight: 500,
    prettifyHtml: false,
    followingToolbar: true,
    codemirror: { // codemirror options
      mode: "application/xml",
      styleActiveLine: true,
      lineNumbers: true,
      lineWrapping: true,
    },
    toolbar: [
      ['misc', ['codeview', 'undo', 'redo']],
      ['style', ['bold', 'italic', 'underline', 'clear']],
      ['para', ['style', 'ul', 'ol', 'paragraph', 'height']],
      ['fontsize', ['fontsize']],
      ['color', ['color']],
      ['insert', ['link', 'picture', 'hr', 'video', 'table', 'emoji']],
    ],
    callbacks: {

      onImageUpload: function (files) {

        fncSweetAlert(
          "loading",
          "Cargando imagen...",
        );

        for (let i = 0; i < files.length; i++) {

          upload(files[i])

        }

      }
    }

  })

}

/*=============================================
Adicionar fondo blanco al toolbar de summernote
Adicionar iconos al toolbar de summernote
=============================================*/

if ($(".note-toolbar").length > 0) {

  $(".note-toolbar").addClass("bg-white");

  $(".emoji-picker").removeClass("fa-smile-o");
  $(".emoji-picker").addClass("fa-smile");

  $("[aria-label='More Color']").html(`<i class="fas fa-caret-down"></i>`)

}

/*=============================================
Subir imagen al servidor
=============================================*/

function upload(file) {

  let data = new FormData();
  data.append('file', file, file.name);

  $.ajax({

    url: "/ajax/upload.ajax.php",
    method: "POST",
    data: data,
    contentType: false,
    cache: false,
    processData: false,
    success: function (response) {

      fncSweetAlert("close",
        null,
        null
      );

      switch (response) {

        case "size":

          fncNotie(
            3,
            "Error: la imagen debe pesar menos de 10MB"
          );

          return;

          break;

        case "type":

          fncNotie(
            3,
            "Error: la imagen debe ser formayo JPG, PNG o GIF"
          );

          return;

          break;

        case "process":

          fncNotie(
            3,
            "Error en el proceso de subir la imagen"
          );

          return;

          break;
      }

      $('.summernote').summernote('insertImage', response, function ($image) {

        $image.attr('class', 'img-fluid');
        $image.css('width', '100%');

      });

      console.log("response", response);

    },

    error: function (jqXHR, textStatus, errorThrown) {

      console.log("jqXHR", jqXHR);

      if (response == "type") {

        fncNotie(
          3,
          textStatus + " " + errorThrown

        );

        return;
      }
    }

  })

}

/*=============================================
Cambio de variante: Galería o video
=============================================*/

function changeVariant(event, item) {

  if (event.target.value == "video") {

    $(".inputVideo_" + item).show();
    $(".iframeYoutube_" + item).show();
    $(".dropzone_" + item).hide();
    $(".galleryProduct_" + item).hide();

  } else {

    $(".inputVideo_" + item).hide();
    $(".iframeYoutube_" + item).hide();
    $(".dropzone_" + item).show();
    $(".galleryProduct_" + item).show();

  }
}

/*=============================================
DropZone
=============================================*/

Dropzone.autoDiscover = false;

function initDropzone(item){

  $(".dropzone_"+item).dropzone({

    url: "/",
    addRemoveLinks: true,
    acceptedFiles: "image/jpeg, image/png, image/gif",
    maxFilesize: 10,
    maxFiles: 10,
    init: function () {

      let elem = $(this.element);

      let arrayFiles = [];

      let countArrayFiles = 0;

      this.on("addedfile", function (file) {

        countArrayFiles++;

        setTimeout(function () {

          arrayFiles.push({

            "file": file.dataURL,
            "type": file.type,
            "width": file.width,
            "height": file.height

          })

          elem.parent().children(".galleryProduct_"+item).val(JSON.stringify(arrayFiles));

        }, 500 * countArrayFiles)

      })

      this.on("removedfile", function (file) {

        countArrayFiles++;

        setTimeout(function () {

          let index = arrayFiles.indexOf({

            "file": file.dataURL,
            "type": file.type,
            "width": file.width,
            "height": file.height

          })

          arrayFiles.splice(index, 1);

          elem.parent().children(".galleryProduct_"+item).val(JSON.stringify(arrayFiles));

        }, 500 * countArrayFiles)

      })

      let myDropzone = this;

      $(".saveBtn").click(function () {

        if (arrayFiles.length >= 1 || $(".galleryOldProduct_"+item).val() != null || $(".type_variant_"+item).val() == "video") {

          myDropzone.processQueue();

        } else {

          fncSweetAlert("error", "La galería no puede estar vacía", null)

        }

      })
    }

  });

}


/*===============================================================
Activar DropZone de acuerdo a la cantidad de galerias existentes
================================================================*/

let numDropzone = $(".dropzone");

for(let item = 1; item <= numDropzone.length; item++){

  initDropzone(item);

}


/*=============================================
Insertar Video de Youtube
=============================================*/

function changeVideo(event, item) {

  let idYoutube = event.target.value.split("/").slice(-1);
  $(".iframeYoutube_" + item).attr("src", "https://www.youtube.com/embed/" + idYoutube)

}

/*=============================================
Edición de Galeria
=============================================*/

let arrayFilesEdit = Array();
let arrayFilesDelete = Array();

function removeGallery(elem, item) {

  $(elem).parent().remove();

  let index = JSON.parse($(".galleryOldProduct_" + item).val()).indexOf($(elem).attr("remove"));

  arrayFilesEdit = JSON.parse($(".galleryOldProduct_" + item).val());

  arrayFilesEdit.splice(index, 1);

  $(".galleryOldProduct_" + item).val(JSON.stringify(arrayFilesEdit));

  arrayFilesDelete = JSON.parse($(".deleteGalleryProduct_" + item).val());

  arrayFilesDelete.push($(elem).attr("remove"));

  $(".deleteGalleryProduct_" + item).val(JSON.stringify(arrayFilesDelete));


}

/*=============================================
Adicionar Variante
=============================================*/


$(document).on("click", ".addVariant", function () {

  let variantItem =  Number($('[name="totalVariants"]').val()) + 1;

  $(".variantList").append(`
    
    <div class="col variantCount">

      <div class="card">

        <div class="card-body">

          <div class="form-group">

             <div class="d-flex justify-content-between">

              <label for="info_product">Variante ${variantItem}<sup class="text-danger">*</sup></label>

                <div>
                  <button type="button" class="btn btn-default btn-sm rounded-pill px-3 quitVariant"><i class="fas fa-times fa-xs"></i> Quitar esta variante</button>
                </div>

              </div>

          </div>
          
           <div class="row row-cols-1 row-cols-md-2">

                <div class="col">

                    <!--=================================================
                    Tipo de variante 
                    =================================================-->

                    <div class="form-group">

                        <select
                            class="custom-select"
                            name="type_variant_${variantItem}"
                            onchange="changeVariant(event, ${variantItem})">

                            <option value="gallery">Galería de fotos</option>
                            <option value="video">Video</option>

                        </select>

                    </div>

                    <!--=================================================
                Galeria del Producto
                =================================================-->

                    <div class="dropzone dropzone_${variantItem} mb-3">

                        <!--=================================================
                            Plugin Dropzone
                            =================================================-->

                        <div class="dz-message">

                            Arrastra tus imágenes acá, tamaño máximo 400px * 450px

                        </div>

                    </div>

                    <input type="hidden" name="galleryProduct_${variantItem}" class="galleryProduct_${variantItem}">
                    <input type="hidden" name="galleryOldProduct_${variantItem}" class="galleryOldProduct_${variantItem}" value='[]'>
                    <input type="hidden" name="deleteGalleryProduct_${variantItem}" class="deleteGalleryProduct_${variantItem}" value='[]'>

                    <!--=================================================
                Insertar video Youtube
                =================================================-->

                    <div class="input-group mb-3 inputVideo_${variantItem}" style="display:none">

                        <span class="input-group-text">
                            <i class="fas fa-clipboard-list"></i>
                        </span>

                        <input
                            type="text"
                            class="form-control"
                            name="videoProduct_${variantItem}"
                            placeholder="Ingresar la URL de Youtube"
                            onchange="changeVideo(event, ${variantItem})">

                    </div>

                    <iframe width="100%" height="280" src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen class="mb-3 iframeYoutube_${variantItem}" style="display:none"></iframe>

                </div>

                <div class="col">

                    <!--=================================================
                Descripció de la variante
                =================================================-->

                    <div class="input-group mb-3">

                        <span class="input-group-text"><i class="fas fa-clipboard-list"></i></span>

                        <input type="text" class="form-control" name="description_variant_${variantItem}" placeholder="Descripción: Color Negro, talla S, Material Goma">

                    </div>

                    <!--=================================================
                Costo de la variante
                =================================================-->

                    <div class="input-group mb-3">

                        <span class="input-group-text"><i class="fas fa-hand-holding-usd"></i></span>

                        <input type="number" step="any" class="form-control" name="cost_variant_${variantItem}" placeholder="Costo de compra">

                    </div>

                    <!--=================================================
                Precio de la variante
                =================================================-->

                    <div class="input-group mb-3">

                        <span class="input-group-text"><i class="fas fa-funnel-dollar"></i></span>

                        <input type="number" step="any" class="form-control" name="price_variant_${variantItem}" placeholder="Precio de venta">

                    </div>

                    <!--=================================================
                Oferta de la variante
                =================================================-->

                    <div class="input-group mb-3">

                        <span class="input-group-text"><i class="fas fa-tag"></i></span>

                        <input type="number" step="any" class="form-control" name="offer_variant_${variantItem}" placeholder="Precio de descuento">

                    </div>

                    <!--=================================================
                Fin de Oferta de la variante
                =================================================-->

                    <div class="input-group mb-3">

                        <span class="input-group-text">Fin del descuento</span>

                        <input type="date" class="form-control" name="date_variant_${variantItem}">

                    </div>

                    <!--=================================================
                Stock de la variante
                =================================================-->

                    <div class="input-group mb-3">

                        <span class="input-group-text"><i class="fas fa-list"></i></span>

                        <input type="number" class="form-control" name="stock_variant_${variantItem}" placeholder="Stock disponible">

                    </div>



                </div>

            </div>

        </div>

      </div>

    </div>


    `)

    $('[name="totalVariants"]').val(variantItem);

    initDropzone(variantItem)

})



