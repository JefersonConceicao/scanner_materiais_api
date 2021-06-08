const { default: Swal } = require("sweetalert2");

$(function(){
    habilitaEventos()
    habilitaBotoes()
})

const grid = "#gridProjetoAtividade";
const modalObject = "#nivel1";

const changeTitle = function(){
    document.title = "BT | Projetos de Atividades";
}

const habilitaEventos = function(){
    $("#searchFormProjetoAtividades").on("submit", function(e){
        e.preventDefault()

        getProjetosAtividades()
    })
}

const habilitaBotoes = function(){
    AppUsage.deleteMultipleRowsHelper(grid, function(){
        $(".deleteALL").on("click", function(){
            const url = '/projetoAtividades/deleteAll'
            const ids = $("tr.row-selected").map(function(index, element){
                return $(element).attr("key");
            });

            AppUsage.deleteMultipleRowsGrid(url, ids, function(){
                getProjetosAtividades()
            })
        });
    })


    $(grid + " .pagination > li > a").on("click", function(e){
        e.preventDefault()

        const url = $(this).attr("href");

        if(!!url){
            getProjetosAtividades(url)
        }
    })

    $("#addProjetoAtividade").on("click", function(){
        const url = '/projetoAtividades/create';

        AppUsage.loadModal(url, modalObject, '50%', function(){
            $("#addFormProjetoAtividade").on("submit", function(e){
                e.preventDefault()

                formProjetosAtividades()
            });
        })
    });

    $(".btnEditProjetoAtividade").on("click", function(){
        const id = $(this).attr("id");
        const url = '/projetoAtividades/edit/' + id;

        AppUsage.loadModal(url, modalObject, '50%', function(){
            $("#editFormProjetoAtividade").on("submit", function(e){
                e.preventDefault()

                formProjetosAtividades(id)
            });
        })
    });

    $(".btnDeleteProjetoAtividade").on("click", function(){
        const id = $(this).attr("id")
        const url = '/projetoAtividades/delete/' + id;

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
        }).then(result => {
            if(result.isConfirmed){
                AppUsage.deleteForGrid(url, function(){
                    getProjetosAtividades()
                })
            }
        })
    })
}


const getProjetosAtividades =  function(url){
    const form = $("#searchFormProjetoAtividades").serialize();

    $.ajax({
        type: "GET",
        url: typeof url !== "undefined" ? url : "/projetoAtividades/",
        data: form,
        dataType: "HTML",
        beforeSend:function(){
            AppUsage.loading($(grid));
        },
        success: function (response) {
           $(grid).html($(response).find(`${grid} >`));
            habilitaBotoes();
        }
    });
}

const formProjetosAtividades = function(id){
    let form = typeof id == "undefined" ? '#addFormProjetoAtividade' : "#editFormProjetoAtividade";
    let url =  typeof id == "undefined" ? '/projetoAtividades/store' : `/projetoAtividades/update/${id}`
    let type = typeof id == "undefined" ? 'POST' : 'PUT';

    $.ajax({
        type,
        url,
        data: $(form).serialize(),
        dataType: "JSON",
        beforeSend:function(){
            $(form + " .btnSubmit").prop("disabled", true).html(`
                <i class="fa fa-spinner fa-spin"> </i> Carregando...
            `)      
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
            
            getProjetosAtividades()
        },
        error:function(jqXHR, textstatus, error){
            if(!!jqXHR.responseJSON.errors){
                const errors = jqXHR.responseJSON.errors;

                AppUsage.showMessagesValidator(form, errors);
            }

        },
        complete:function(){
            $(form + " .btnSubmit").prop("disabled", false).html(`
                Salvar
            `)      
        }
    });
}

module.exports = {
    changeTitle,
    habilitaBotoes,
    habilitaEventos
}