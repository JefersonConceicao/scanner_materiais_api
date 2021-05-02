$(function(){
    habilitaBotoes();
    habilitaEventos();
}); 

const habilitaEventos = function(){
    $("#changePassword").on("submit", function(e){
        e.preventDefault();
        let form = $(this).serialize();

        if(!!form){
            formChangePassword(form);  
        }
    })
}

const habilitaBotoes = function(){
    $(".profilePicture").on("click", function(){
        const paramsDrozpone = {
            url: '/users/changePhoto',
        }
        
        AppUsage.configDropzone(paramsDrozpone);
    });
}

const formChangePassword = function(form){
    let url = '/users/changePassword'

    $.ajax({
        method: "PUT",
        data: form, 
        url,
        beforeSend:function(){
            $(".changePassword").prop("disabled", true).html(`
                <i class="fa fa-spinner fa-spin"> </i> 
                Carregando
            `)    
        },
        success:function(response){
            Swal.fire({
                position: 'top-end',
                icon: !response.error ? 'success' : 'error',
                iconColor: '#ffff', 
                title: `<b style="color:#fff"> ${response.msg} </b>`,
                toast: true,
                showConfirmButton: false,
                timer: 3500,
                background: !response.error ? '#337ab7' : '#e91313',
                timerProgressBar: true,
                didOpen:(toast) => {
                    $(toast).on('mouseenter', function(){
                        Swal.stopTimer();
                    })  

                    $(toast).on('mouseleave', function(){
                        Swal.resumeTimer();
                    })
                }
            }); 

            if(!response.error){
                $("input[type='password']").val("");
                $(".error_feedback").html("");
            }
        },
        error:function(jqXHR, textStatus, error){
            if(!!jqXHR.responseJSON.errors){
                AppUsage.showMessagesValidator("#changePassword", jqXHR.responseJSON.errors);
            }
        },
        complete:function(){
            $(".changePassword").prop("disabled", false).html("Confirmar alteração");
        },
    })
}


module.exports = {
    habilitaBotoes,
    habilitaEventos,
}