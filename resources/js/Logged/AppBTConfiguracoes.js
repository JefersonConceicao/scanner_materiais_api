$(function(){
    habilitaEventos();
    habilitaBotoes();
});

const changeTitle = function(){
    document.title = 'BT | Configurações';
}

const habilitaEventos = function(){
    $(".cardConfig").on("click", function(){
        const url = $(this).attr("url");
        const module = $(this).attr("requestjs");

        AppNavigation.getNewScreen(url, module);
    })
}

const habilitaBotoes = function(){

}

module.exports = {
    changeTitle,
    habilitaEventos,
    habilitaBotoes
}