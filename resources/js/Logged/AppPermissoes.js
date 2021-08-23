$(function(){
    habilitaBotoes()
    habilitaEventos()
})

const modalObject = "#nivel1";

const changeTitle = function(){
    document.title = "Admin | Permissões";
}


const habilitaEventos = function(){
    $(".refreshDash").on("click", function(){
        loadConsPermissoes();
    });
}

const habilitaBotoes = function(){
    AppModulos.habilitaBotoes()

    $("#syncPermissions").on("click", function(e){
        e.preventDefault();
        const url = '/permissoes/create';

        AppUsage.loadModal(url, modalObject, '800px')
    });

    $("#gerModules").on("click", function(){
        const url = "/modulos/"   

        AppUsage.loadModal(url, modalObject, '500px', function(){
            AppModulos.habilitaBotoes();
            AppModulos.habilitaEventos();
        });
    });

    $("#cadastrarFuncionalidade").on("click", function(){
        const url = "/funcionalidades/create";

        AppUsage.loadModal(url, modalObject, '600px', function(){
            AppFuncionalidades.habilitaBotoes();
            AppFuncionalidades.habilitaEventos();
        });
    });

    $(".editFuncionalidade").on("click", function(){
        const id = $(this).attr('id');
        const url = "/funcionalidades/edit/" + id;

        AppUsage.loadModal(url, modalObject, '600px', function(){
            AppFuncionalidades.habilitaBotoes();
            AppFuncionalidades.habilitaEventos(id);
        })
    });

    $("#reSession").on('click', function(){
        const url = '/permissoes/renderViewSessionRevalid'

        AppUsage.loadModal(url, modalObject, '900px', function(){
            $("#reloadSession").on("submit", function(e){
                e.preventDefault();

                formReloadSession();     
            })
        })
    })

    $(".deleteFuncionalidade").on("click", function(){
        const element = $(this)
        const id = element.attr("id")
        const url = "/funcionalidades/delete/" + id;
   
        Swal.fire({
            title: 'Deseja realmente excluir o registro?',
            icon: 'warning',
            text: 'Esta ação é irreversivel!',
            showCancelButton: true,
            showConfirmButton: true,
            reverseButtons: true,
            confirmButtonText: 'Sim, excluir!',
            cancelButtonText: 'Cancelar',
            cancelButtonColor: '#e91313',
        }).then(result => {
            if(result.isConfirmed){
                AppUsage.deleteForGrid(url, function(){
                    element.parent().parent().parent().remove();
                })    
            }
        })
    });
}

const loadConsPermissoes = function(){
    let url = '/permissoes/'
    let grid = "#gridDash"

    $.ajax({
        type: "GET",
        url,
        dataType: "HTML",
        beforeSend:function(){
            AppUsage.loading($(grid));
        },
        success: function (response) {
            $(grid).html($(response).find(`${grid} >`))
            habilitaBotoes()
        }
    });
}

const formReloadSession = function(){
    const url = '/permissoes/reloadSession';
    const form = "#reloadSession";

    $.ajax({
        type: "POST",
        url,
        data: $(form).serialize(),
        dataType: "JSON",
        beforeSend:function(){
            $(form + " .btnSubmit").prop("disabled", true).html(
                `<i class="fa fa-spinner fa-spin"> </i> Carregando...` 
            )
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
                let errors = jqXHR.responseJSON.errors; 
                AppUsage.showMessagesValidator(form, errors);
            }
        },  
        complete:function(){
            $(form + " .btnSubmit").prop("disabled", false).html(
                `Salvar` 
            )
        },
    });

}

module.exports = {
    habilitaEventos,
    habilitaBotoes,
    changeTitle,
}