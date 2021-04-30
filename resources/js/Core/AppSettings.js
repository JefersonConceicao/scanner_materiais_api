const { default: Swal } = require("sweetalert2");

$(function(){
    setupAjax();
    adjustingDropDown();
})

const adjustingDropDown = function(){
    $('.table-responsive').on('shown.bs.dropdown', function (e) {
        var $table = $(this),
            $menu = $(e.target).find('.dropdown-menu'),
            tableOffsetHeight = $table.offset().top + $table.height(),
            menuOffsetHeight = $menu.offset().top + $menu.outerHeight(true);

        if (menuOffsetHeight > tableOffsetHeight){
            $table.css("padding-bottom", menuOffsetHeight - tableOffsetHeight);
        }
    });

    $(".table-responsive").on("hide.bs.dropdown", function(){
        $(this).css('padding-bottom', 0)
    })

    $(".dropdown-menu > li > a").css('color', 'black');
}

const setupAjax = function(){   

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    })

    $(document).ajaxSuccess(function(event, xhr, settings){
        if(!$.fn.DataTable.isDataTable($('.dataTable'))){
            AppUsage.initializeDataTable();
        }
    })

    $(document).ajaxError(function(event, jqXHR, ajaxSettings, error){
        // if(jqXHR.status == 500){
        //     Swal.fire({
        //         position:'top-end',
        //         icon: 'error',
        //         title: 'Ocorreu um erro interno, tente novamente mais tarde ou abra um chamado',
        //         toast: true,
        //         time: 3000,
        //         showConfirmButton: false,
        //     })
        // }
    });
}

module.exports = {
    setupAjax,
}