$(function(){
    setupAjax();
    adjustingDropDown();
    settingsAnimateFilter();
    configDropdown();
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
        
        configDropdown();
    })

    $(document).ajaxError(function(event, jqXHR, ajaxSettings, error){
         if(jqXHR.status == 500){
            Swal.fire({
                position:'top-end',
                icon: 'error',
                title: `<b style="color:#ffff"> Ocorreu um erro interno, tente novamente mais tarde ou abra um chamado </b>`,
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
            if($("#nivel2").hasClass("in")){
                $("#nivel2").modal('hide');
            }
    
            const url = '/permissoes/methodNotAllowed'
            AppUsage.loadModal(url, '#nivel1', '600px');
        }
    });
}

const settingsAnimateFilter = function(){
    $("#targetCollapseFilter").on("click", function(){
       $(this).toggleClass('activeFilter');
    });

    $(".dropActions").on("click", function(){
        const element = $(this);
        const expanded = element.attr("aria-expanded");

        if(expanded === "true"){
            element.find('.fa-angle-down').removeClass('animation-angle-up').addClass('animation-angle-down')
        }else{
            element.find('.fa-angle-down').removeClass('animation-angle-down').addClass('animation-angle-up')
        }
    });
}  

const configDropdown = function(){
    $(".table-responsive").on("shown.bs.dropdown", function(e){
        let $table = $(this); 
        let $menu = $(e.target).find('.dropdown-menu');

        let tableOffsetHeight = $table.offset().top + $table.height(); 
        let menuOffsetHeight = $menu.offset().top + $menu.outerHeight(true);

        if(menuOffsetHeight > tableOffsetHeight){
            $table.css('padding-bottom', menuOffsetHeight - tableOffsetHeight);
        }
    })
    
    $(".table-responsive").on("hide.bs.dropdown", function(e){
        $(this).css('padding-bottom', 0);

        if($('.fa-angle-down').hasClass('animation-angle-up')){
            $('.fa-angle-down').removeClass('animation-angle-up').addClass("animation-angle-down");
        }
    });    
}

module.exports = {
    setupAjax,
    settingsAnimateFilter
}