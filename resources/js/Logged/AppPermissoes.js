$(function(){
    habilitaBotoes()
    habilitaEventos()
})

const modalObject = "#nivel1";

const habilitaEventos = function(){

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


    
module.exports = {
    habilitaEventos,
    habilitaBotoes,
}