const { default: Swal } = require("sweetalert2");

$(function(){
    habilitaBotoes()
    habilitaEventos()
});

const modalObject = "#nivel1";
const grid = "#gridElementoDespesa";

const changeTitle = function(){
    document.title = " BT | Elementos de Despesa";
}
    
const habilitaEventos = function(){
    $("#formSearchElementoDespesa").on("submit", function(e){
        e.preventDefault()
        getElementoDespesa()
    });
}

const habilitaBotoes = function(){
    $(grid + " .pagination > li > a").on("click", function(e){
        e.preventDefault();

        const url = $(this).attr("href");

        if(!!url){
            getElementoDespesa(url);
        }
    });

    AppUsage.deleteMultipleRowsHelper(grid, function(){
        $(".deleteALL").on("click", function(){
            const url = '/elementoDespesas/deleteAll'
            const ids = $("tr.row-selected").map(function(index, element){
                return $(element).attr("key");
            });

            AppUsage.deleteMultipleRowsGrid(url, ids, function(){
                getElementoDespesa();  
            })
        });
    });

    $("#addElementoDespesa").on("click", function(){
        const url = '/elementoDespesas/create';

        AppUsage.loadModal(url, modalObject, '50%', function(){
            $("#formAddElementoDespesa").on("submit", function(e){
                e.preventDefault()
                formElementoDespesa()
            });
        }); 
    });

    $(".btnEditElementoDespesa").on("click", function(){
        const id = $(this).attr("id");
        const url = '/elementoDespesas/edit/' + id;

        AppUsage.loadModal(url, modalObject, '50%', function(){
            $("#formEditElementoDespesa").on("submit", function(e){
                e.preventDefault()
                formElementoDespesa(id)
            });
        });
    })

    $(".btnDeleteElementoDespesa").on("click", function(){
        const id = $(this).attr("id");
        const url = '/elementoDespesas/delete/' + id;

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
                    getElementoDespesa();
                });
            }
        });
    })

}

const getElementoDespesa = function(url){
    const form = $("#formSearchElementoDespesa").serialize();

    $.ajax({
        type: "GET",
        url: typeof url !== "undefined" ? url : "/elementoDespesas/",
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

const formElementoDespesa = function(id){
    let form = typeof id == "undefined" ? '#formAddElementoDespesa' : "#formEditElementoDespesa";
    let url =  typeof id == "undefined" ? '/elementoDespesas/store' : `/elementoDespesas/update/${id}`
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
            
            getElementoDespesa()
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