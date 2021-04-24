$(function(){
    habilitaBotoes()
    habilitaEventos()
});

const habilitaEventos = function(){
    $("#cadastrarUser").on("click", function(){
       let url = '/users/create'
       AppUsage.loadModal(url, function(){
            
       })
    })
}

const habilitaBotoes = function(){

}

module.exports = {
    habilitaEventos,
    habilitaBotoes,
}