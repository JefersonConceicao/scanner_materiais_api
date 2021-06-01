$(function(){
    habilitaEventos()
    habilitaBotoes()
})

const grid = "#gridLocalidadesInfraestrutura";
const habilitaEventos = function(id){}

const habilitaBotoes = function(id){
    $(grid + " .pagination > li > a").on("click", function(e){
        e.preventDefault();
        const url = $(this).attr("href");

        if(!!url){
            loadGridLocalidadeInfraestrutura(id, url);
        }
    });

    $("#addInfraLocalidade").on("click", function(){
        const url = '/localidades/createInfraLocalidades/' + id;

        AppUsage.loadModal(url, "#nivel2", "60%", function(){
            $("#addInfraLocalidades").on("submit", function(e){
                e.preventDefault();

                formLocalidadeInfraestrutura(id, "save");
            });
        });
    });

    $(".btnEditLocalidadeInfraestrutura").on("click", function(){
        const idLocInfra = $(this).attr("id");
        const url = '/localidades/editInfraLocalidades/' + idLocInfra;

        AppUsage.loadModal(url, "#nivel2", "60%", function(){
            $("#editInfraLocalidades").on("submit", function(e){
                e.preventDefault();

                formLocalidadeInfraestrutura(id, "update", { idUpdate: idLocInfra})
            });
        });
    });

    $(".btnDeleteLocalidadeInfraestrutura").on("click", function(){
        const idLocInfra = $(this).attr("id");
        const url = '/localidades/deleteInfraLocalidades/' + idLocInfra;

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
                    loadGridLocalidadeInfraestrutura(id);
                })
            }
        });
    })
}

const formLocalidadeInfraestrutura = function(id, action, params = null){
    let modalObject = "#nivel2"
    let form =  action == "save" ? '#addInfraLocalidades' : "#editInfraLocalidades";
    let url =  action == "save" ? '/localidades/storeInfraLocalidades' : `/localidades/updateInfraLocalidades/${params.idUpdate}`
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

            loadGridLocalidadeInfraestrutura(id);
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

const loadGridLocalidadeInfraestrutura = function(id, urlPaginate){
    const url = typeof urlPaginate === "undefined" ? '/localidades/details/' + id : urlPaginate;
    const grid = "#gridLocalidadesInfraestrutura";

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
    habilitaEventos,
    habilitaBotoes,
}