$(function(){
    habilitaBotoes();
    habilitaEventos();
}); 

const setTitle = function(){
    return document.title = "Admin | Perfil"
}

const configDropzoneProfile = function(){
    var myDropzone = new Dropzone(".profilePicture", {
        url: '/users/uploadPhotoProfile',
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        acceptedFiles: 'image/*',
    })

    return myDropzone
}

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
    if($(".profilePicture").length > 0){
        var myDropzone = configDropzoneProfile();
    }
    
    $(".profilePicture").on("click", function(){
        myDropzone.on('success', function(file, response){  
            if(!response.error){
                $(".profilePicture").attr("src", response.file) 
                $(".menuImgProfile").attr("src", response.file)
                $(".subMenuImgProfile").attr("src", response.file);
            }else{
                Swal.fire({
                    showConfirmButton: false,
                    position: 'top-end',
                    icon: 'error',
                    toast:true,
                    title: 'Algo deu errado, tente novamente mais tarde ou abra um chamado',
                    iconColor: 'red',
                    timer: 3000,
                    didOpen:(toast) => {
                        toast.addEventListener('mouseenter', function(){
                            timer.stopTimer()
                        })

                        toast.addEventListener('mouseleave', function(){
                            timer.resumeTimer()
                        })
                    }
                })
            }
        })  
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
    setTitle,
}