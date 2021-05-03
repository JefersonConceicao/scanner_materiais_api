$(function(){
    habilitaBotoes()
    habilitaEventos()
})

const modalObject = "#nivel1";

const habilitaBotoes = function(){

}

const habilitaEventos = function(){
    $("#syncPermissions").on("click", function(e){
        e.preventDefault();
        let url = '/permissoes/create';

        AppUsage.loadModal(url, modalObject, '800px', function(){

        })
    });
}
    
module.exports = {
    habilitaEventos,
    habilitaBotoes,
}