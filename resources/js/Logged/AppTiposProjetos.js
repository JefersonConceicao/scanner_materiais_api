const { default: Swal } = require("sweetalert2");
const { color } = require('../Constants/constants');

$(function(){
    habilitaEventos();
    habilitaBotoes();
});

const grid = "#gridTiposProjetos";
const modalObject = '#nivel1';

const changeTitle = function(){
    document.title = "BT | Tipos de Projetos";
}

const habilitaEventos = function(){
    $("#searchFormTipoProjeto").on("submit", function(e){
        e.preventDefault();

        getTiposProjetosFilter();
    })
}

const habilitaBotoes = function(){
    $(grid + " .pagination > li > a").on("click", function(e){
        e.preventDefault();
        const url = $(this).attr("href");

        if(!!url){
            getTiposProjetosFilter(url);
        }
    })


    $("#addTiposProjeto").on("click", function(){
        const url = '/tiposProjetos/create';
        
        AppUsage.loadModal(url, modalObject, '60%', function(){
            $("#addFormTiposProjetos").on("submit", function(e){
                e.preventDefault();

                formTiposProjetos();
            });
        });
    });

    $(".btnEditTipoProjeto").on("click", function(){
        const id = $(this).attr("id");
        const url = '/tiposProjetos/edit/' + id;

        AppUsage.loadModal(url, modalObject, '60%', function(){
            $("#editFormTiposProjetos").on("submit", function(e){
                e.preventDefault();

                formTiposProjetos(id);
            })
        });
    });

    $(".btnDeleteTipoProjeto").on("click", function(){
        const id = $(this).attr("id");
        const url = '/tiposProjetos/delete/' + id;

        Swal.fire({
            title: 'Tem certeza?',
            text: 'Esta ação é irreversível',
            icon: 'warning',
            showCancelButton: true,
            showConfirmButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Confirmar',
            cancelButtonColor: color().vermelhoBahia,
            confirmButtonColor: color().azulBahia,
            reverseButtons:true,
        }).then(result => {
            if(result.isConfirmed){
                AppUsage.deleteForGrid(url, function(){
                    getTiposProjetosFilter();
                })
            }
        })
    })
}

const formTiposProjetos = function(id){
    let form = typeof id == "undefined" ? '#addFormTiposProjetos' : "#editFormTiposProjetos";
    let url =  typeof id == "undefined" ? '/tiposProjetos/store' : `/tiposProjetos/update/${id}`
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
            
            getTiposProjetosFilter()
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

const getTiposProjetosFilter = function(url){
    let form = $("#searchFormTipoProjeto").serialize();

    $.ajax({
        type: "GET",
        url: typeof url !== "undefined" ? url : "/tiposProjetos/",
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