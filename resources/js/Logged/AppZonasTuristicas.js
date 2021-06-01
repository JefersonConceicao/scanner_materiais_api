const { elementInside } = require("dropzone");
const { default: Swal } = require("sweetalert2");

$(function(){
    habilitaBotoes();
    habilitaEventos();
})

const modalObject = "#nivel1";
const grid = "#gridZT";

const changeTitle = function(){
    document.title = 'BT | Zonas Turísticas';
}

const habilitaEventos = function(){
    $("#formSearchZT").on("submit", function(e){
        e.preventDefault();

        getZTFilter();
    });

    $("#addZT").on("click", function(){
        const url = '/zonasTuristicas/create';

        AppUsage.loadModal(url, modalObject, '800px', function(){
            $("#addFormZT").on("submit", function(e){
                e.preventDefault();

                formZT();
            });
        })
    })
}   

const habilitaBotoes = function(){
    AppUsage.deleteMultipleRowsHelper(function(){
        $(".deleteALL").on("click", function(){
            const url = '/zonasTuristicas/deleteAll'
            const ids = $("tr.row-selected").map(function(index, element){
                return $(element).attr("key")
            });

            AppUsage.deleteMultipleRowsGrid(url, ids, function(){
                getZTFilter();  
            })
        })
    })


    $(grid + " .pagination > li > a").on("click", function(e){
        e.preventDefault()
        const url = $(this).attr("href");

        if(!!url){
            getZTFilter(url);
        }
    })

    $(".btnEditZT").on("click", function(){
        const id = $(this).attr("id");
        const url = "/zonasTuristicas/edit/" + id;

        AppUsage.loadModal(url, modalObject, '800px', function(){
            $("#editFormZT").on("submit", function(e){
                e.preventDefault()

                formZT(id);
            })
        })
    })      

    $(".btnDeleteZT").on("click", function(){
        const id = $(this).attr("id");
        const url = '/zonasTuristicas/delete/' + id;

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
                    getZTFilter();
                })
            }
        });
    });
}

const getZTFilter = function(url){
    let form = $("#formSearchZT").serialize();

    $.ajax({
        type: "GET",
        url: typeof url !== "undefined" ? url : "/zonasTuristicas/",
        data: form,
        dataType: "HTML",
        beforeSend:function(jqXHR, settings){
            AppUsage.loading($(grid));
        },
        success: function (response) {
           $(grid).html($(response).find(`${grid} >`));
            habilitaBotoes();
        }
    });
}

const formZT = function(id){
    let form = typeof id == "undefined" ? '#addFormZT' : "#editFormZT";
    let url =  typeof id == "undefined" ? '/zonasTuristicas/store' : `/zonasTuristicas/update/${id}`
    let type = typeof id == "undefined" ? 'POST' : 'PUT';

    $.ajax({
        type,
        url,
        data: $(form).serialize(),
        dataType: "JSON",
        beforeSend:function(){
            $(form + " .btnSubmit").prop("disabled", true).html(`
                <i class="faf a-spinner fa-spin"> </i> Carregando...
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

            getZTFilter();
        },
        error:function(jqXHR, textStatus, error){
            if(!!jqXHR.responseJSON){
                let errorsRequest = jqXHR.responseJSON.errors;
                AppUsage.showMessagesValidator(form, errorsRequest)
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