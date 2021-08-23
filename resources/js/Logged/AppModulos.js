$(function(){
    habilitaBotoes();
    habilitaEventos();
});

const modalObject = "#nivel2"
const grid = "#gridModulos"

const habilitaEventos = function(){
    $("#addModule").on("click", function(){
        let url = '/modulos/create';
     
        AppUsage.loadModal(url, modalObject, '600px', function(){
            $("#formAddModule").on("submit", function(e){
                e.preventDefault()
                formModule();
            })
        });
    });  
}

const habilitaBotoes = function(){
    $(".btnEditarModule").on("click", function(){
        let id = $(this).attr("id");
        let url = '/modulos/edit/'+id;

        AppUsage.loadModal(url, modalObject, '600px', function(){
            $("#formEditModule").on("submit", function(e){
                e.preventDefault();

                formModule(id);
            })  
        })
    })  

    $(".btnDeleteModule").on("click", function(){
        let id = $(this).attr("id");
        let url = '/modulos/delete/' + id;

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
                    loadConsModules();
                })
            }
        })
    })
}

const loadConsModules = function(){
    let url = '/modulos/'

    $.ajax({
        type: "GET",
        url,
        dataType: "HTML",
        beforeSend:function(){
            AppUsage.loading($(grid))
        },
        success: function (response) {
            $(grid).html($(response).find(modalObject + " #gridModulos >"));
            habilitaBotoes();
        },
    })
}

const formModule = function(id){
    let url = typeof id === "undefined" ? '/modulos/store' : `/modulos/update/${id}` 
    let type = typeof id === "undefined" ? "POST" : "PUT"
    let form = typeof id === "undefined" ? "#formAddModule" : "#formEditModule"

    $.ajax({
        type,
        url,
        data: $(form).serialize(),
        dataType: "JSON",
        beforeSend: function(){
            $(modalObject + " .btnSubmit").prop("disabled", true).html(`
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
                    loadConsModules()
                }
            })
        },
        error:function(jqXHR, textStatus, error){
            if(!!jqXHR.responseJSON.errors){
                let errors = jqXHR.responseJSON.errors; 
                AppUsage.showMessagesValidator(form, errors)
            }
        },
        complete:function(){
            $(modalObject + " .btnSubmit").prop("disabled", false).html(`
                Salvar
            `)
        },
    });
}

module.exports = {
    habilitaBotoes, 
    habilitaEventos,
}