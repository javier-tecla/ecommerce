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

        console.log("totalPages", totalPages);


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