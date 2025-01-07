/*===========================================
Formatear envío de formulario lado servidor
=============================================*/

function fncFormatInputs() {

    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
}

/*===========================================
Alerta Notie
=============================================*/

function fncNotie(type, text){

    notie.alert({

        type: type,
        text:text,
        time:10

    })
}