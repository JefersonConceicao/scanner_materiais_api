$(function(){
    habilitaBotoes()
    habilitaEventos()
});

const modalObject = "#nivel1";
const grid = "#gridUsers";

const changeTitle = function(){
    document.title = 'Admin | Usuários';
}

const habilitaEventos = function(){
    $("#searchUser").on('submit', function(e){
        e.preventDefault();
        
        getUsersFilter();
    });

    $("#clear_filter_user").on('click', function(){
        let selects = $("#role, #setor");
        selects.select2('destroy').val("").select2();
    });
}

const habilitaBotoes = function(){
    AppUsage.deleteMultipleRowsHelper(grid, function(){
        $(".deleteALL").on("click", function(){
            const url = '/users/deleteAll'
            const ids = $("tr.row-selected").map(function(index, element){
                return $(element).attr("key");
            });

            AppUsage.deleteMultipleRowsGrid(url, ids, function(){
                getUsersFilter();  
            })
        });
    })

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

    $(".viewUser").on('click', function(){
        let id = $(this).attr('id');
        let url = `/users/view/${id}`;

        AppUsage.loadModal(url, modalObject, '800px');
    })

    $(".deleteUser").on('click', function(e){
        e.preventDefault();
        let id = $(this).attr("id");
        
        Swal.fire({
            title: 'Deseja realmente excluir o registro?',
            text: 'Esta ação é irreversivel!',
            icon: 'warning',
            showCancelButton: true,
            reverseButtons: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirmar',
            cancelButtonText: 'Cancelar',
            timeProgressBar: true,
        }).then((result) => {
            if(result.isConfirmed){
                AppUsage.deleteForGrid(`/users/destroy/${id}`, function(){
                    getUsersFilter();
                });
            }
        })
    });
}

const getUsersFilter = function(){
    let form = $("#searchUser").serialize();
    let gridUser = "#gridUsers";

    $.ajax({
        type: "GET",
        url: "/users/",
        data: form,
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
                    title: `<b style="color:#fff"> ${response.msg} </b>`,
                    toast: true,
                    showConfirmButton: false,
                    timer: 3500,
                    background: '#337ab7',
                    didOpen:() => {
                       $(modalObject).modal('hide');
                    }
                }); 

                getUsersFilter();
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
            $("input[type='password']").prop("disabled", true).val("");
        }else{
            $("input[type='password']").prop("disabled", false).val("");
        }
    })
}

module.exports = {
    habilitaEventos,
    habilitaBotoes,
    changeTitle,
}