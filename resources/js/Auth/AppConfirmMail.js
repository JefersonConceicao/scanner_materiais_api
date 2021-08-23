$(function(){
    habilitaEventos()
});

const habilitaEventos = function(){
    $("#sendConfirmMail").on("submit", function(e){
        e.preventDefault()
        formConfirmMail()
    });
}

const formConfirmMail = function(){
    const form = "#sendConfirmMail";
    const url = '/requestConfirmMail/';

    $.ajax({
        type: "POST",
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
                showConfirmButton: true,
                icon: response.error ? 'error' : 'success',
                title: response.msg,
                timer: 3000,
            }).then(result => {
                if(result.isConfirmed){
                    window.location.href = '/login';
                }
            })

            $(".error_feedback").html("");
        },
        error:function(jqXHR, textStatus, error){
            if(jqXHR.responseJSON.errors){
                const errors = jqXHR.responseJSON.errors;
                
                AppUsage.showMessagesValidator(form, errors);
            }
        },
        complete:function(){
            $(form + " .btn-primary").prop("disabled", false).html(`
                Confirmar e-mail 
            `)
        }
    });    
}

module.exports = {

}