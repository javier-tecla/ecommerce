/*===========================================
Formatear envío de formulario lado servidor
=============================================*/

function fncFormatInputs() {

    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
}