$(function(){

})

const loadModal = function(url, callback = null){
    let modal = "#myModal"
    $(modal).modal();

    $(modal).find('.modal-content').html("");
    $(modal).find('.modal-content').append(
         `<section>  
             <div class="alert alert-primary"> Carregando... <div>
         </section>`
    )
    
    $(`.modal-content`).load(`${url} .modal-content >`, function(){
        if(!!callback){
            callback();
        }
     }) 
}

module.exports = {
    loadModal,
}