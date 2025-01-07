/*===========================================
Validación Bootstrap 5
=============================================*/
// Disable form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Get the forms we want to add validation styles to
    let forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    let validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
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
Función para validar formularios
=============================================*/

function validateJS(event, type){

    if(type == "email"){

        let pattern = /^[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/;

        if(!pattern.test(event.target.value)){

           $(event.target).parent().addClass("was-validated"); 

           $(event.target).parent().children(".invalid-feedback").html("El correo electrónico está mal escrito"); 

           event.target.value = "";

           return;
        }

       
    }
}
