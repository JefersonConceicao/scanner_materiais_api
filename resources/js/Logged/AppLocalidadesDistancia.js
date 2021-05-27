const { default: Swal } = require("sweetalert2");

$(function(){
    habilitaEventos()
    habilitaBotoes()
})

const habilitaEventos = function(id){

}

const habilitaBotoes = function(id){
    $("#addDistanciaLocalidade").on("click", function(){
        const url = '/localidades/createDistLocalidades/' + id;

        AppUsage.loadModal(url, "#nivel2", '60%', function(){
            $("#addLocalidadeDistancia").on("submit", function(e){
                e.preventDefault()

                formLocalidadeDistancia(id, "save");
            });
        })
    });

    $("#gridLocalidadesDistancia .pagination > li > a").on("click", function(e){
        e.preventDefault();
        const url = $(this).attr("href");

        if(!!url){
            loadGridLocalidadeDistancia(id, url);
        }
    })

    $(".btnEditLocalidadeDistancia").on("click", function(){
        const idLocDist = $(this).attr("id");
        const url = '/localidades/editDistLocalidades/' + idLocDist;

        AppUsage.loadModal(url, "#nivel2", '60%', function(){
            $("#editLocalidadeDistancia").on("submit", function(e){
                e.preventDefault();

                formLocalidadeDistancia(id, "update", { idUpdate: idLocDist})
            })
        })
    });

    $(".btnDeleteLocalidadeDistancia").on("click", function(){
        const idLocDist = $(this).attr("id");
        const url = "/localidades/deleteDistlocalidades/" + idLocDist;
        
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
                    loadGridLocalidadeDistancia(id);
                });
            }
        })
    });
}

const formLocalidadeDistancia = function(id, action, params = null){
    let modalObject = "#nivel2"
    let form =  action == "save" ? '#addLocalidadeDistancia' : "#editLocalidadeDistancia";
    let url =  action == "save" ? '/localidades/storeDistLocalidades' : `/localidades/updateDistLocalidades/${params.idUpdate}`
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

            loadGridLocalidadeDistancia(id);
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

const loadGridLocalidadeDistancia = function(id, urlPaginate){
    const url = typeof urlPaginate === "undefined" ? '/localidades/details/' + id : urlPaginate;
    const grid = "#gridLocalidadesDistancia";

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