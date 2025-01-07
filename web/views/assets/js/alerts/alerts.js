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

function fncNotie(type, text) {

    notie.alert({

        type: type,
        text: text,
        time: 10

    })
}

/*===========================================
Alerta SweetAlert
=============================================*/

function fncSweetAlert(type, text, url) {

    switch (type) {

        case "error":

            if (url == "") {

                Swal.fire({

                    icon: "error",
                    title: "Error",
                    text: text
                })

            } else {

                Swal.fire({

                    icon: "error",
                    title: "Error",
                    text: text

                }).then((result) => {

                    if (result.value) {

                        window.open(url, "top");
                    }
                })

            }

            break;

        case "success":

            if (url == "") {

                Swal.fire({

                    icon: "success",
                    title: "Correcto",
                    text: text
                })

            } else {

                Swal.fire({

                    icon: "error",
                    title: "Error",
                    text: text

                }).then((result) => {

                    if (result.value) {

                        window.open(url, "top");
                    }
                })

            }

            break;

    }


}


/*===========================================
Alerta Toast
=============================================*/

function fncToastr(type, text) {

    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 6000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)

        }

    })

    Toast.fire({
        icon: type,
        title: text
    })
}