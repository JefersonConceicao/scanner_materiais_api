$(function(){
    loadLibs();
})

const loadLibs = function(){
    console.log("hum");
    //FUNÇÃO QUE HABILITA EVENTOS DE BIBLIOTECAS

    //SELECT2 
    $(".select2").select2({
        language:'pt-BR',
        placeholder: 'Selecione uma opção',
        allowClear:true,
        width:'100%',
    });
}

const loadModal = function(url, modalObject, width = null, callback = null){
    $(modalObject).modal({
        backdrop: 'static',
    });

    $(modalObject).find('.modal-content').html("");

    $(modalObject).find('.modal-dialog').css({
        width: !!width ? width : '800px'
    });

    $(modalObject).find('.modal-content').append(
         `<section>  
             <div class="alert alert-primary"> <i class="fa fa-spinner fa-spin"> </i> Carregando... <div>
         </section>`
    )
        
    $(modalObject).find(`.modal-content`).load(`${url} .modal-content >`, function(){
        //Executa novamente loadLibs para novo HTML 
        loadLibs();

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