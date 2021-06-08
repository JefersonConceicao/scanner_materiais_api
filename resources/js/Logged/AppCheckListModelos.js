const { default: Swal } = require("sweetalert2");

$(function(){
    habilitaBotoes()
    habilitaEventos()
});

const modalObject = "#nivel1";
const grid = "#gridCheckListModelos";

const changeTitle = function(){
    document.title = 'BT | Checklist de Modelos'
}

const habilitaEventos = function(){
    $("#formSearchCheckListModelos").on("submit", function(e){
        e.preventDefault();

        getCheckListModelos();
    })   
}

const habilitaBotoes = function(){
    $(grid + " .pagination > li > a").on("click", function(e){
        e.preventDefault();
        const url = $(this).attr("href");

        if(!!url){
            getCheckListModelos(url)
        }
    })

    $("#addChkEstruturas").on("click", function(){
        const url = '/checkListModelos/create';

        AppUsage.loadModal(url, modalObject, "40%", function(){
            $("#addCheckListModelo").on("submit", function(e){
                e.preventDefault() 

                formCheckListModelos()
            });
        })
    });

    $(".btnEditCheckListModelos").on("click", function(){
        const id = $(this).attr("id");
        const url = '/checkListModelos/edit/' + id;

        AppUsage.loadModal(url, modalObject, "40%", function(){
            $("#editCheckListModelo").on("submit", function(e){
                e.preventDefault() 

                formCheckListModelos(id)
            })
        });
    });

    $(".btnDeleteCheckListModelos").on("click", function(){
        const id = $(this).attr("id");
        const url = '/checkListModelos/delete/' + id;

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
                    getCheckListModelos();
                })
            }
        });
    });
}

const getCheckListModelos = function(url){
    const form = $("#formSearchCheckListModelos").serialize();

    $.ajax({
        type: "GET",
        url: typeof url !== "undefined" ? url : "/checkListModelos/",
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

const formCheckListModelos = function(id){
    let form = typeof id == "undefined" ? '#addCheckListModelo' : "#editCheckListModelo";
    let url =  typeof id == "undefined" ? '/checkListModelos/store' : `/checkListModelos/update/${id}`
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
            
            getCheckListModelos()
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
    habilitaEventos,
}