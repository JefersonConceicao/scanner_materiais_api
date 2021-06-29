const { default: Swal } = require("sweetalert2");

$(function(){
    habilitaEventos()
    habilitaBotoes()
})

const habilitaEventos = function(){
    $("#sendRecoveryPass").on("submit", function(e){
        e.preventDefault()
        formRecoveryPassword();
    }); 

    $("#recoveryPassword").on("submit", function(e){
        e.preventDefault();
        formChangePassword();
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
            Swal.fire({
                showConfirmButton:true,
                title: response.msg,
                icon: response.error ? 'error' : 'success',
            }).then(result => {
                if(result.isConfirmed){
                    window.location.href = '/login';
                }
            })
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

const formChangePassword = function(){
    const form = "#recoveryPassword";
    const url = "/password/resetPassword";

    $.ajax({
        type: "PUT",
        url,
        data: $(form).serialize(),
        dataType: "JSON",
        beforeSend:function(){
            $(form + " .btn-primary").prop("disabled", true).html(`
                <i class="fa fa-spinner fa-spin"> </i> Carregando...
            `)
        },
        success: function (response) {
            Swal.fire({
                showConfirmButton:true,
                title: response.msg,
                icon: response.error ? 'error' : 'success'   
            }).then(result => {
                if(result.isConfirmed){
                    window.location.href = '/login';
                }
            })
        },
        error:function(jqXHR, textStatus, error){
            if(!!jqXHR.responseJSON.errors){
                const errors = jqXHR.responseJSON.errors;

                AppUsage.showMessagesValidator(form, errors);
            }
        },
        complete:function(){
            $(form + " .btn-primary").prop("disabled", true).html(`
                Alterar senha
            `)
        }
    });
}

module.exports = {
    habilitaEventos,
    habilitaBotoes,
}