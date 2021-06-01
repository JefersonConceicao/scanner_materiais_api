$(function(){
    habilitaBotoes();
    habilitaEventos();
})

const modalObject = '#nivel1';
const grid = "#gridTiposEventosFestas";

const changeTitle = function(){
    document.title = "BT | Tipos Eventos/Festas";
}

const habilitaEventos = function(){
    $("#formSearchEventoTipoFesta").on("submit", function(e){
        e.preventDefault();

        getTiposEventosFestas();
    });

    $("#addTiposEventosFesta").on("click", function(){
        const url = '/tiposEventosFestas/create';

        AppUsage.loadModal(url, modalObject, '800px', function(){
            $("#addFormTiposEventosFestas").on("submit", function(e){
                e.preventDefault();

                formTiposEventosFestas()
            }); 
        });
    });
}

const habilitaBotoes = function(){
    AppUsage.deleteMultipleRowsHelper(grid, function(){
        $(".deleteALL").on("click", function(){
            const url = '/tiposEventosFestas/deleteAll'
            const ids = $("tr.row-selected").map(function(index, element){
                return $(element).attr("key");
            });

            AppUsage.deleteMultipleRowsGrid(url, ids, function(){
                getTiposEventosFestas();
            })
        });
    });

    $(".btnTefEdit").on("click", function(){
        const id = $(this).attr("id");
        const url = '/tiposEventosFestas/edit/' + id;

        AppUsage.loadModal(url, modalObject, '800px', function(){
            $("#editFormTiposEventosFestas").on("submit", function(e){
                e.preventDefault();

                formTiposEventosFestas(id)
            });
        });
    })

    $(".btnTefDelete").on("click", function(){
        const id = $(this).attr("id");
        const url = "/tiposEventosFestas/delete/" + id;

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
        }).then(result => {
            if(result.isConfirmed){
                AppUsage.deleteForGrid(url, function(){
                    getTiposEventosFestas(); 
                })
            }
        })
    })
}

const getTiposEventosFestas = function(url){
    let form = $("#formSearchEventoTipoFesta").serialize();

    $.ajax({
        type: "GET",
        url: typeof url !== "undefined" ? url : "/tiposEventosFestas/",
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

const formTiposEventosFestas = function(id){
    let form = typeof id == "undefined" ? '#addFormTiposEventosFestas' : "#editFormTiposEventosFestas";
    let url =  typeof id == "undefined" ? '/tiposEventosFestas/store' : `/tiposEventosFestas/update/${id}`
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
            
            getTiposEventosFestas()
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
    habilitaBotoes,
    habilitaEventos,
    changeTitle,
}