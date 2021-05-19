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
         if(jqXHR.status == 500){
            Swal.fire({
                position:'top-end',
                icon: 'error',
                title: `<p style="color:#ffff"> Ocorreu um erro interno, tente novamente mais tarde ou abra um chamado </p>`,
                toast: true,
                timer: 3000,    
                showConfirmButton: false,
                timerProgressBar:true,
                background: '#e91313', 
                didOpen:(toast) => {
                    toast.addEventListener('mouseenter', function(){
                        Swal.stopTimer();
                    })

                    toast.addEventListener('mouseleave', function(){
                        Swal.resumeTimer()
                    })
                }
            })
        }
        
        if(jqXHR.status === 401){
            const url = '/permissoes/methodNotAllowed'
            AppUsage.loadModal(url, '#nivel1', '600px');
        }
    });
}

module.exports = {
    setupAjax,
}