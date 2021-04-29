$(function(){
    habilitaBotoes()
    habilitaEventos()
});

const modalObject = "#nivel1";

const habilitaEventos = function(){
    $("#searchUser").on('submit', function(e){
        e.preventDefault();
        let form = $(this).serialize();

        getUsersFilter(form);
    });

    $("#clear_filter_user").on('click', function(){
        let selects = $("#role, #setor");
        selects.select2('destroy').val("").select2();
    });
}

const habilitaBotoes = function(){
    $("#cadastrarUser").on("click", function(){
        let url = '/users/create'
        AppUsage.loadModal(url, modalObject, '800px', function(){
            formDataUser();
        })
    })

    $(".editaUser").on("click", function(){
        let id = $(this).attr('id');
        let url = `/users/edit/${id}`

        AppUsage.loadModal(url, modalObject, '800px', function(){
            eventShowPassword();    
            formDataUser(id);
        })
    });
}

const getUsersFilter = function(searchformData){
    let gridUser = "#gridUsers";

    $.ajax({
        type: "GET",
        url: "/users/",
        data: searchformData,
        dataType: "HTML",
        beforeSend:function(jqXHR, settings){
            AppUsage.loading($(gridUser));
        },
        success: function (response) {
           $(gridUser).html($(response).find(`${gridUser} >`));
            habilitaBotoes();
        }
    });
}

const formDataUser = function(id){
    let form = typeof id == "undefined" ? '#create_user' : "#edit_user";
    let url =  typeof id == "undefined" ? '/users/store' : `/users/update/${id}`
    let type = typeof id == "undefined" ? 'POST' : 'PUT';

    $(form).on('submit', function(e){
        e.preventDefault();
        let formSerialize = $(this).serialize();   

        $.ajax({
            type,
            url,
            data: formSerialize,
            beforeSend:function(){
                $(".btnSubmit").prop("disabled", true).html(`
                    <b> <i class="fa fa-spinner fa-spin"> </i> Carregando...   </b>
                `)
            },
            success:function(response){
                Swal.fire({
                    position: 'top-end',
                    icon: !response.error ? 'success' : 'error',
                    title: response.msg,
                    toast: true,
                    showConfirmButton: false,
                    timer:2000,
                    didOpen:() => {
                       $(modalObject).modal('hide');
                    }
                }); 
            },
            error:function(jqXHR, textStatus, errorThrown){
                if(!!jqXHR.responseJSON){
                    let errorsRequest = jqXHR.responseJSON.errors;
                    AppUsage.showMessagesValidator(form, errorsRequest)
                }
            },
            complete:function(){
                $(".btnSubmit").prop("disabled", false).html('Salvar');
            }
        })
    });
}

const eventShowPassword = function(){
    $('a[href="#change_password"]').on('click', function(e){
        if($("#change_password").hasClass('in')){
            $("input[type='password']").prop("disabled", true);
        }else{
            $("input[type='password']").prop("disabled", false);
        }
    })
}

module.exports = {
    habilitaEventos,
    habilitaBotoes,
}