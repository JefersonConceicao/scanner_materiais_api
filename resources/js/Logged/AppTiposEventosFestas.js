$(function(){
    habilitaBotoes();
    habilitaEventos();
})

const modalObject = '#nivel1';
const grid = "#gridTiposEventosFestas";

const changeTitle = function(){
    document.title = "BT | Tipos Eventos/Festas";
}

const habilitaEventos = function(){
    $("#formSearchEventoTipoFesta").on("submit", function(e){
        e.preventDefault();

        getTiposEventosFestas();
    });

    $("#addTiposEventosFesta").on("click", function(){
        const url = '/tiposEventosFestas/create';

        AppUsage.loadModal(url, modalObject, '800px', function(){

        });
    });
}

const habilitaBotoes = function(){

}

const getTiposEventosFestas = function(url){
    let form = $("#formSearchEventoTipoFesta").serialize();

    $.ajax({
        type: "GET",
        url: typeof url !== "undefined" ? url : "/tiposEventosFestas/",
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
    habilitaBotoes,
    habilitaEventos,
    changeTitle,
}