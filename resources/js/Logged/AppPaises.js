const { default: Swal } = require("sweetalert2");

$(function(){
    habilitaBotoes();
    habilitaEventos();
});

const modalObject = "#nivel1";
const grid = "#gridPais"

const changeTitle = function(){
    document.title = 'BT | País';
}

const habilitaEventos = function(){
    $("#addPais").on("click", function(){
        const url = '/paises/create';

        AppUsage.loadModal(url, modalObject, '800px', function(){
            $("#addFormPais").on("submit", function(e){
                e.preventDefault();
                formPaises();
            })
        });
    });

    $("#searchFilterPaises").on("submit", function(e){
        e.preventDefault();
        getPaisesFilter()
    });
}

const habilitaBotoes = function(){
    AppUsage.deleteMultipleRowsHelper(grid, function(){
        $(".deleteALL").on("click", function(){
            const url = '/paises/deleteAll'
            const ids = $("tr.row-selected").map(function(index, element){
                return $(element).attr("key");
            });

            AppUsage.deleteMultipleRowsGrid(url, ids, function(){
                getPaisesFilter();
            });
        });
    });

    $(grid + " .pagination > li > a").on("click", function(e){
        e.preventDefault();
        const url = $(this).attr("href");

        if(!!url){
            getPaisesFilter(url);
        }
    })


    $(".editPais").on("click", function(){
        const id = $(this).attr("id");
        const url = '/paises/edit/' + id;

        AppUsage.loadModal(url, modalObject, '800px', function(){
            $("#editFormPais").on("submit", function(e){
                e.preventDefault();

                formPaises(id);
            }) 
        })
    })

    $(".deletePais").on("click", function(){
        const id = $(this).attr("id");
        const url = '/paises/delete/' + id;

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
                    getPaisesFilter();
                });
            }
        })
    })
}

const getPaisesFilter = function(url){
    let form =  $("#searchFilterPaises").serialize();
    
    $.ajax({
        type: "GET",
        url: typeof url !== "undefined" ? url : "/paises/",
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

const formPaises = function(id){
    let form = typeof id == "undefined" ? '#addFormPais' : "#editFormPais";
    let url =  typeof id == "undefined" ? '/paises/store' : `/paises/update/${id}`
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

            getPaisesFilter()
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