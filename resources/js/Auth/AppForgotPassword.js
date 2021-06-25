$(function(){
    habilitaEventos()
    habilitaBotoes()
})

const habilitaEventos = function(){
    $("#sendRecoveryPass").on("submit", function(e){
        e.preventDefault()
        formRecoveryPassword();
    }); 
}

const habilitaBotoes = function(){}

const formRecoveryPassword = function(){
    const url = '/users/recoveryPass';
    const form = "#sendRecoveryPass"; 

    $.ajax({
        type: "POST",
        url,
        data: $(form).serialize(),
        dataType: "JSON",
        beforeSend: function(){
            $(form + " .btn-primary")
                .prop("disabled", true)
                .html(`<i class="fa fa-spinner fa-spin"> </i> &nbsp; Carregando ...`)
        },
        success: function (response) {
            console.log(response);
        },
        error:function(jqXHR, textStatus, error){
            if(!!jqXHR.responseJSON.errors){
                const errors = jqXHR.responseJSON.errors;

                AppUsage.showMessagesValidator(form, errors);
            }
        },
        complete:function(){
            $(form + " .btn-primary")
                .prop("disabled", false)
                .html(`Recuperar minha senha`)
        }
    });
}

module.exports = {
    habilitaEventos,
    habilitaBotoes,
}