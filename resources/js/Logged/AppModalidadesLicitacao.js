const { default: Swal } = require("sweetalert2");

$(function(){
    habilitaEventos()
    habilitaBotoes()
})

const grid = "#gridModalidadeLicitacao";
const modalObject = "#nivel1";

const changeTitle = function(){
    document.title = 'BT | Modalidades de Licitações'
}

const habilitaEventos = function(){
    $("#searchFormModalidadeLicitacao").on("submit", function(e){
        e.preventDefault();

        getModalidadesLicitacao();
    });
}

const habilitaBotoes = function(){
    AppUsage.deleteMultipleRowsHelper(grid, function(){
        $(".deleteALL").on("click", function(){
            const url = '/modalidadesLicitacao/deleteAll'
            const ids = $("tr.row-selected").map(function(index, element){
                return $(element).attr("key");
            });

            AppUsage.deleteMultipleRowsGrid(url, ids, function(){
                getModalidadesLicitacao();  
            })
        })
    })

    $(grid + " .pagination > li > a").on("click", function(e){
        e.preventDefault()
        const url = $(this).attr("href");

        if(!!url){
            getModalidadesLicitacao(url)
        }
    }) 

    $("#addModalidadeLicitacao").on("click", function(){
        const url = '/modalidadesLicitacao/create';

        AppUsage.loadModal(url, modalObject, '50%', function(){
            $("#addFormModalidadeLicitacao").on("submit", function(e){
                e.preventDefault()
                formModalidadesLicitacao()
            })
        })
    });

    $(".btnEditModalidadeLicitacao").on("click", function(){
        const id = $(this).attr("id");
        const url = '/modalidadesLicitacao/edit/' + id;

        AppUsage.loadModal(url, modalObject, '50%', function(){
            $("#editFormModalidadeLicitacao").on("submit", function(e){
                e.preventDefault()
                formModalidadesLicitacao(id)
            })
        });
    })

    $(".btnDeleteModalidadeLicitacao").on("click", function(){
        const id = $(this).attr("id");
        const url = '/modalidadesLicitacao/delete/' + id; 

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
                    getModalidadesLicitacao()
                })
            }
        })
    })
}

const formModalidadesLicitacao = function(id){
    let form = typeof id == "undefined" ? '#addFormModalidadeLicitacao' : "#editFormModalidadeLicitacao";
    let url =  typeof id == "undefined" ? '/modalidadesLicitacao/store' : `/modalidadesLicitacao/update/${id}`
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
            
            getModalidadesLicitacao()
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

const getModalidadesLicitacao = function(url){
    const form = $("#searchFormModalidadeLicitacao").serialize();

    $.ajax({
        type: "GET",
        url: typeof url !== "undefined" ? url : "/modalidadesLicitacao/",
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

module.exports = {
    changeTitle,
    habilitaEventos,
    habilitaBotoes,
}