$(function(){
    habilitaBotoes();
    habilitaEventos();
})

const modalObject = "#nivel1";
const grid = "#gridTiposIE";

const habilitaEventos = function(){
    $("#formSearchTiposIE").on("submit", function(e){
        e.preventDefault()
        getTiposIEFilter();
    })

    $("#addTipoIE").on("click", function(){
        const url = '/tiposInfraestruturas/create'

        AppUsage.loadModal(url, modalObject, '800px', function(){
            $("#addFormTipoInfraestrutura").on("submit", function(e){
                e.preventDefault();
                formTiposIE();
            });
        });
    })
}

const habilitaBotoes = function(){
    AppUsage.deleteMultipleRowsHelper(grid, function(){
        $(".deleteALL").on("click", function(){
            const url = "/tiposInfraestruturas/deleteAll"
            const ids = $("tr.row-selected").map(function(index, element){
                return $(element).attr("key");
            });

            AppUsage.deleteMultipleRowsGrid(url, ids, function(){
                getTiposIEFilter();
            })
        })
    });

    $(grid + " .pagination > li > a").on("click", function(e){
        e.preventDefault();
        const url = $(this).attr("href");

        if(!!url){
            getTiposIEFilter(url);
        }
    })

    $(".btnEditTiposIE").on("click", function(){
        const id = $(this).attr("id");
        const url = '/tiposInfraestruturas/edit/' + id;

        AppUsage.loadModal(url, modalObject, '800px', function(){
            $("#editFormTipoInfraestrutura").on("submit", function(e){
                e.preventDefault();

                formTiposIE(id);
            });
        }); 
    });

    $(".btnDeleteTiposIE").on("click", function(){
        const id = $(this).attr("id");
        const url = '/tiposInfraestruturas/delete/' + id;

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
                    getTiposIEFilter();
                })
            }
        })
    })
}

const getTiposIEFilter = function(url){
    let form = $("#formSearchTiposIE").serialize();

    $.ajax({
        type: "GET",
        url: typeof url !== "undefined" ? url : "/tiposInfraestruturas/",
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

const formTiposIE = function(id){
    let form = typeof id == "undefined" ? '#addFormTipoInfraestrutura' : "#editFormTipoInfraestrutura";
    let url =  typeof id == "undefined" ? '/tiposInfraestruturas/store' : `/tiposInfraestruturas/update/${id}`
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
            
            getTiposIEFilter()
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
    habilitaEventos
}