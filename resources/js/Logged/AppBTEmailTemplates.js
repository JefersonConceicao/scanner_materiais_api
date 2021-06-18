$(function(){
    habilitaEventos();
    habilitaBotoes();
});

const modalObject = "#nivel1";
const grid = "#gridBTEmailTemplates";

const changeTitle = function(){

}

const habilitaEventos = function(){

}

const habilitaBotoes = function(){
    $("#addBTEmailTemplate").on("click", function(){
        const url = '/btEmailTemplates/create';

        AppUsage.loadModal(url, modalObject, '60%', function(){

        })
    })
}

module.exports = {
    changeTitle,
    habilitaEventos,
    habilitaBotoes
}

