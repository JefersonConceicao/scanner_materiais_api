const { default: Swal } = require("sweetalert2");

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

    $("#editaUser").on("click", function(){
        let id = $(this).attr('id');
        let url = `/users/edit/${id}`
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
                
            },
            success:function(repsonse){
                console.log(repsonse);
            },
            error:function(jqXHR, textStatus, errorThrown){
                if(!!jqXHR.responseJSON){
                    let errorsRequest = jqXHR.responseJSON.errors;
                    AppUsage.showMessagesValidator(form, errorsRequest)
                }
            },
            complete:function(){

            }
        })
    });
}

module.exports = {
    habilitaEventos,
    habilitaBotoes,
}