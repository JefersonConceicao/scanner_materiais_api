$(function(){
    habilitaBotoes();
    habilitaEventos();
})

const modalObject = "#nivel1";

const habilitaEventos = function(id = null){
    $("#modalFormAddFunc").on("submit", function(e){
        e.preventDefault();
        formFuncionalidade()
    })   

    $("#modalFormEditFunc").on("submit", function(e){
        e.preventDefault();

        if(!!id){
           formFuncionalidade(id)
        }   
    })
}

const habilitaBotoes = function(){}

const formFuncionalidade = function(id){
    let url = typeof id === "undefined" ? '/funcionalidades/store' : `/funcionalidades/update/${id}`
    let type = typeof id === "undefined" ? "POST" : "PUT"
    let form = typeof id === "undefined" ? "#modalFormAddFunc" : "#modalFormEditFunc"

    $.ajax({
        type,
        url,
        data: $(form).serialize(),
        dataType: "JSON",
        beforeSend:function(){
            $(form + " .btnSubmit").prop("disabled", true).html(`
                <i class="fa fa-spinner fa-spin"> </i> Carregando...
            `)
        },
        success: function (response) {
            Swal.fire({
                position: 'top-end',
                icon: !response.error ? 'success' : 'error',
                title: `<b style="color:#fff"> ${response.msg} </b>`,
                toast: true,
                showConfirmButton: false,
                timer: 3500,
                background: '#337ab7',
                didOpen:() => {
                   $(modalObject).modal('hide');
                }  
            });
        },
        error:function(jqXHR, textstatus, error){
            if(!!jqXHR.responseJSON.errors){
                let errors = jqXHR.responseJSON.errors
                AppUsage.showMessagesValidator(form, errors);
            }
        },
        complete:function(){
            $(form + " .btnSubmit").prop("disabled", false).html(`
                Salvar
            `)
        },
    });
}

module.exports = {
    habilitaBotoes,
    habilitaEventos,
}