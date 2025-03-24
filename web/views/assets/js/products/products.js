/*===================================
Grid & List
===================================*/

$(document).on("click", ".btnView", function () {

    let type = $(this).attr("attr-type");
    let btnType = $("[attr-type]");
    let index = $(this).attr("attr-index");

    if (type == "list") {

        $(".grid-" + index).hide();
        $(".list-" + index).show();

    }

    if (type == "grid") {

        $(".grid-" + index).show();
        $(".list-" + index).hide();

    }

    btnType.each(function (i) {

        if ($(btnType[i]).attr("attr-index") == index) {

            $(btnType[i]).removeClass("bg-white");
        }

    })

    $(this).addClass("bg-white");

})

/*===================================
Paginación
===================================*/

let target = $('.pagination');

if (target.length > 0) {

    target.each(function () {

        let el = $(this),
            totalPages = el.data("total-pages"),
            urlPage = el.data("url-page"),
            currentPage = el.data("current-page");

        el.twbsPagination({
            totalPages: totalPages,
            startPage: currentPage,
            visiblePages: 3,
            first: '<i class="fas fa-angle-double-left"></i>',
            last: '<i class="fas fa-angle-double-right"></i>',
            prev: '<i class="fas fa-angle-left"></i>',
            next: '<i class="fas fa-angle-right"></i>',
            onPageClick: function (event, page) {

                if (page == 1) {

                    $(".page-item.first").css({ "color": "#aaa" })
                    $(".page-item.prev").css({ "color": "#aaa" })
                }

                if (page == totalPages) {

                    $(".page-item.next").css({ "color": "#aaa" })
                    $(".page-item.last").css({ "color": "#aaa" })

                }
            }
        }).on("page", function (event, page) {

            window.location = "/" + urlPage + "/" + page;
        })

    })

}

/*===================================
Función para buscar productos
===================================*/

$(document).on("click", ".btnSearch", function () {

    let value = $(this).parent().parent().children(".inputSearch").val().toLowerCase();

    value = value.replace(/[#\\;\\$\\&\\%\\=\\(\\)\\:\\,\\'\\"\\.\\¿\\¡\\!\\?]/g, "");
    value = value.replace(/[ ]/g, "-");
    value = value.replace(/[á]/g, "a");
    value = value.replace(/[é]/g, "e");
    value = value.replace(/[í]/g, "i");
    value = value.replace(/[ó]/g, "o");
    value = value.replace(/[ú]/g, "u");
    value = value.replace(/[ñ]/g, "n");

    window.location = "/" + value;
})

/*============================================
Función para buscar productos con tecla Enter
==============================================*/

$(".inputSearch").keyup(function (event) {

    event.preventDefault();

    if (event.keyCode == 13 && $(".inputSearch").val() != "") {

        let value = $(".inputSearch").val().toLowerCase();

        value = value.replace(/[#\\;\\$\\&\\%\\=\\(\\)\\:\\,\\'\\"\\.\\¿\\¡\\!\\?]/g, "");
        value = value.replace(/[ ]/g, "-");
        value = value.replace(/[á]/g, "a");
        value = value.replace(/[é]/g, "e");
        value = value.replace(/[í]/g, "i");
        value = value.replace(/[ó]/g, "o");
        value = value.replace(/[ú]/g, "u");
        value = value.replace(/[ñ]/g, "n");

        window.location = "/" + value;
    }
})

/*============================================
Adicionar a favoritos
==============================================*/

$(document).on("click",".addFavorite",function(){

	var idProduct = $(this).attr("idProduct");
	var elem = $(this);
	$(elem).children("i").css({"color":"#dc3545"})
	
	var data = new FormData();
	data.append("token", localStorage.getItem("token-user"));
	data.append("idProduct", idProduct);

	$.ajax({

		url:"/ajax/forms.ajax.php",
		method: "POST",
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: function (response){ 
        	
        	if(JSON.parse(response).comment == "The process was successful"){

        		$(elem).attr("idFavorite",JSON.parse(response).lastId);
        		$(elem).removeClass("addFavorite");
        		$(elem).addClass("remFavorite");

        		fncToastr("success","El producto ha sido agregado a su lista de favoritos");
        	}

        }

	})

})

/*============================================
Quitar de favoritos
==============================================*/

$(document).on("click", ".remFavorite", function () {

    let idFavorite = $(this).attr("idFavorite");
    let elem = $(this);
    $(elem).children("i").css({ "color": "#000" })

    let data = new FormData();
    data.append("token", localStorage.getItem("token-user"));
    data.append("idFavorite", idFavorite);

    $.ajax({

        url: "/ajax/forms.ajax.php",
        method: "POST",
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {

            if(response == 200){

                $(elem).addClass("addFavorite");
                $(elem).removeClass("remFavorite");
                

                fncToastr("success","El producto ha sido removido de su lista de favoritos");
            }

        }
    })
})
