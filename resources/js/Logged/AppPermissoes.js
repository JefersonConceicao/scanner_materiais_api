const { default: Swal } = require("sweetalert2");

$(function(){
    habilitaBotoes()
    habilitaEventos()
})

const modalObject = "#nivel1";
const habilitaEventos = function(){
    $(".refreshDash").on("click", function(){
        loadConsPermissoes();
    });
}

const habilitaBotoes = function(){
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


module.exports = {
    habilitaEventos,
    habilitaBotoes,
}