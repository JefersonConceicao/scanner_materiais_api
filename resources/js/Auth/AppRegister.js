$(function(){
    habilitaEventos()
});

const habilitaEventos = function(){
    $("#signUPUser").on("submit", function(e){
        e.preventDefault();
        formSignUpUser();
    });
}

const formSignUpUser = function(){
    const form = "#signUPUser";
    const url = "/saveSignUp";
    
    $.ajax({
        type: "POST",
        url,
        data: $(form).serialize(),
        dataType: "JSON",
        beforeSend: function(){
            $(".submitSignUP").prop("disabled", true).html(
                `<i class="fa fa-spinner fa-spin"> </i> <b> Carregando... </b>`
            )
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
            $(".submitSignUP").prop("disabled", false).html(
                ` Enviar ` 
            )
        }
    });
}

module.exports = {

}