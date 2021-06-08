const { default: Swal } = require("sweetalert2");

$(function(){
    habilitaBotoes()
    habilitaEventos()
});

const grid = "#gridModalidadeApoio";
const modalObject = "#nivel1";

const changeTitle = function(){
    document.title = "BT | Modalidades de Apoio";
}

const habilitaEventos = function(){
    $("#searchFormModalidadeApoio").on("submit", function(e){
        e.preventDefault()
        getModalidadesApoio()
    });
}

const habilitaBotoes = function(){
    $(grid + " .pagination > li > a").on("click", function(e){
        e.preventDefault()

        const url = $(this).attr("href");

        if(!!url){
            getModalidadesApoio(url);
        }
    });

    $("#addModalidadeApoio").on("click", function(){
        const url = '/modalidadesApoio/create';

        AppUsage.loadModal(url, modalObject, '40%', function(){
            $("#addFormModalidadeApoio").on("submit", function(e){
                e.preventDefault();

                formModalidadesApoio();
            });
        }); 
    }) 
    
    $(".btnEditModalidadeApoio").on("click", function(){
        const id = $(this).attr("id");
        const url = '/modalidadesApoio/edit/' + id;

        AppUsage.loadModal(url, modalObject, '50%', function(){
            $("#editFormModalidadeApoio").on("submit", function(e){
                e.preventDefault();

                formModalidadesApoio(id);
            });
        })
    }); 

    $(".btnDeleteModalidadeApoio").on("click", function(){
        const id = $(this).attr("id");
        const url = '/modalidadesApoio/delete/' + id;

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
                    getModalidadesApoio();
                });
            }
        })
    });
}

const getModalidadesApoio = function(url){
    const form = $("#searchFormModalidadeApoio").serialize();

    $.ajax({
        type: "GET",
        url: typeof url !== "undefined" ? url : "/modalidadesApoio/",
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

const formModalidadesApoio = function(id){
    let form = typeof id == "undefined" ? '#addFormModalidadeApoio' : "#editFormModalidadeApoio";
    let url =  typeof id == "undefined" ? '/modalidadesApoio/store' : `/modalidadesApoio/update/${id}`
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
            
            getModalidadesApoio()
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
    habilitaEventos,
    habilitaBotoes
}