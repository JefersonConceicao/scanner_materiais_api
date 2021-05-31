$(function(){
    habilitaBotoes();
    habilitaEventos();
});

const grid = "#gridSetores";
const modalObject = "#nivel1";

const habilitaEventos = function(){
    $("#formSearchSetores").on("submit", function(e){
        e.preventDefault();
        getSetoresFilter();
    })
}

const habilitaBotoes = function(){

}

const getSetoresFilter = function(){
    let form = $("#formSearchSetores").serialize();

    $.ajax({
        type: "GET",
        url: typeof url !== "undefined" ? url : "/setores/",
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
    habilitaEventos,
    habilitaBotoes,
}