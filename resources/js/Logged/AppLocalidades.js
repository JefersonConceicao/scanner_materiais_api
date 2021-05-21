$(function(){
    habilitaEventos()
    habilitaBotoes()
});

const modalObject = "#nivel1";
const grid = "#gridLocalidade";

const changeTitle = function(){
    window.title = "BT | Localidades";
}

const habilitaEventos = function(){
    $("#formSearchFilterLocalidades").on("submit", function(e){
        e.preventDefault();

        getLocalidadesFilter();
    });
}

const habilitaBotoes = function(){
    $("#addLocalidade").on("click", function(){
        const url = "/localidades/create";
    
        AppUsage.loadModal(url, modalObject, '1600px', function(){

        });
    });

    $(grid + " .pagination > li > a").on("click", function(e){
        e.preventDefault();
        const url = $(this).attr("href");

        if(!!url){
            getLocalidadesFilter(url);
        }
    })
}

const getLocalidadesFilter = function(url){
    const form = $("#formSearchFilterLocalidades").serialize();

    $.ajax({
        type: "GET",
        url: typeof url !== "undefined" ? url : "/localidades/",
        data: form,
        dataType: "HTML",
        beforeSend:function(){
            AppUsage.loading($(grid));
        },
        success: function (response) {
           $(grid).html($(response).find(`${grid} >`));
            habilitaBotoes();
        }
    });

}

module.exports = {
    changeTitle,
    habilitaEventos,
    habilitaBotoes,
}