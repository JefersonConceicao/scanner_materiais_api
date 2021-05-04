$(function(){
    habilitaBotoes()
    habilitaEventos()
})

const modalObject = "#nivel1";

const habilitaEventos = function(){
    $(".refreshDash").on("click", function(){
        loadConsPermissoes();
    })


    $("#syncPermissions").on("click", function(e){
        e.preventDefault();
        let url = '/permissoes/create';

        AppUsage.loadModal(url, modalObject, '800px', function(){

        })
    });

    $("#gerModules").on("click", function(){
        let url = "/modulos/"   

        AppUsage.loadModal(url, modalObject, '500px', function(){
            AppModulos.habilitaBotoes();
            AppModulos.habilitaEventos();
        });
    })

}

const habilitaBotoes = function(){

}

const loadConsPermissoes = function(){
    let url = '/permissoes/'
    let grid = "#gridDash"

    $.ajax({
        type: "GET",
        url,
        dataType: "HTML",
        beforeSend:function(){
            AppUsage.loading($(grid));
        },
        success: function (response) {
            $(grid).html($(response).find(`${grid} >`))  
            habilitaEventos()
            habilitaBotoes()
        }
    });
}


    
module.exports = {
    habilitaEventos,
    habilitaBotoes,
}