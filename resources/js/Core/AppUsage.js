$(function(){
    loadLibs();
})

const loadLibs = function(){
    //FUNÇÃO QUE HABILITA EVENTOS DE BIBLIOTECAS

    //SELECT2 
    $(".select2").select2({
        language:'pt-BR',
        placeholder: 'Selecione uma opção',
        allowClear:true,
        width:'100%',
    });

    


}

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

//PARAM - ELEMENTO A SER REMOVIDO PARA INSERÇÃO DO LOADING
const loading = function(element){
    element.closest(element).html(`
        <div class="alert alert-danger">
            <div class="text-center">    
                <b> 
                    <i 
                        class="fa fa-circle-o-notch fa-spin" aria-hidden="true"
                        style="font-size:30px;"
                    >  
                    </i>   
                </b>
            </div>
        </div>
    `)
}

module.exports = {
    loadModal,
    loadLibs,
    loading,
}