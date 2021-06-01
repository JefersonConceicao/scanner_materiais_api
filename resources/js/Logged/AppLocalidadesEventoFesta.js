const { default: Swal } = require("sweetalert2")
const { color } = require("../Constants/constants");

$(function(){
    habilitaEventos()
    habilitaBotoes()
})

const grid = "#gridLocalidadesEventoFesta"
const habilitaEventos = function(id){}

const habilitaBotoes = function(id){
    $(grid + " .pagination > li > a").on("click", function(e){
        e.preventDefault();
        const url = $(this).attr("href");

        if(!!url){
            loadGridLocalidadeEventoFesta(id, url);
        }
    });

    $("#createEFLocalidade").on("click", function(){
        const url = '/localidades/createEFLocalidade'

        AppUsage.loadModal(url, "#nivel2", "60%", function(){
            $("#addEFLocalidade").on("submit", function(e){
                e.preventDefault();
                formLocalidadeEventoFesta(id, "save");
            }); 
        });
    });

    $(".btnEditLocalidadeEventoFesta").on("click", function(){
        const idUpdate = $(this).attr("id");
        const url = '/localidades/editEFLocalidade/' + idUpdate

        AppUsage.loadModal(url, "#nivel2", "60%", function(){
            $("#editEFLocalidade").on("submit", function(e){
                e.preventDefault();
                
                formLocalidadeEventoFesta(id, "update", {idUpdate});
            });
        });
    });

    $(".btnDeleteLocalidadeEventoFesta").on("click", function(){
        const idDelete = $(this).attr("id");
        const url = '/localidades/deleteEFLocalidade/' + idDelete;

        Swal.fire({
            title: 'Tem certeza?',
            text: 'Esta ação é irreversível',
            icon: 'warning',
            showCancelButton: true,
            showConfirmButton: true,
            reverseButtons:true,
            cancelButtonText: 'Cancelar',
            cancelButtonColor: color().vermelhoBahia,
            confirmButtonText: 'Sim, excluir!',
            confirmButtonColor: color().azulBahia
        }).then(result => {
            if(result.isConfirmed){
                AppUsage.deleteForGrid(url, function(){
                    loadGridLocalidadeEventoFesta(id);
                });
            }
        })
    });
}

const formLocalidadeEventoFesta = function(id, action, params = null){
    let modalObject = "#nivel2"
    let form =  action == "save" ? '#addEFLocalidade' : "#editEFLocalidade";
    let url =  action == "save" ? '/localidades/storeEFLocalidade' : `/localidades/updateEFLocalidade/${params.idUpdate}`
    let type = action == "save" ? 'POST' : 'PUT';

    $.ajax({
        type,
        url,
        data: $(form).serialize()+`&id=${id}`,   
        dataType: "JSON",   
        beforeSend: function(){
            $(form + " .btnSubmit").prop("disabled", true).html(
                `<i class="fa fa-spinner fa-spin"> </i> Carregando...`
            )
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

            loadGridLocalidadeEventoFesta(id);
        },
        error:function(jqXHR, textstatus, error){
            if(!!jqXHR.responseJSON.errors){
                const errors = jqXHR.responseJSON.errors;

                AppUsage.showMessagesValidator(form, errors);
            }
        },
        complete: function(){
            $(form + " .btnSubmit").prop("disabled", false).html(
                `Salvar`
            )
        }
    });
}

const loadGridLocalidadeEventoFesta = function(id, urlPaginate){
    const url = typeof urlPaginate === "undefined" ? '/localidades/details/' + id : urlPaginate;
    const grid = "#gridLocalidadesEventoFesta";

    $.ajax({
        type:'GET',
        url, 
        beforeSend:function(){
            AppUsage.loading($(grid));
        },
        success:function(response){ 
            $(grid).html($(response).find(`#nivel1 ${grid} >`));
            habilitaBotoes(id);
        },
    })
}

module.exports = {
    habilitaBotoes,
    habilitaEventos,
}