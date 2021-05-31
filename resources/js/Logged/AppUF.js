$(function(){
    habilitaEventos()
    habilitaBotoes()
})

const modalObject = "#nivel1";
const grid = "#gridUF";

const changeTitle = function(){
    document.title = "BT | Unidades Federativas";
}

const habilitaEventos = function(){
    $("#formSearchUF").on("submit", function(e){
        e.preventDefault();
        getUFFilter()
    })  

    $("#addUF").on("click", function(){
        const url = '/uf/create'

        AppUsage.loadModal(url, modalObject, '800px', function(){
            $("#addFormUF").on('submit', function(e){
                e.preventDefault();
                formUF()
            })
        });
    })
}

const habilitaBotoes = function(){
    AppUsage.deleteMultipleRowsHelper(grid, function(){
        $(".deleteALL").on("click", function(){
            const url = '/uf/deleteAll'
            const ids = $("tr.row-selected").map(function(index, element){
                return $(element).attr("key");
            });

            AppUsage.deleteMultipleRowsGrid(url, ids, function(){
                getUFFilter();  
            })
        });
    });

    $("#gridUF .pagination > li > a").on("click", function(e){
        e.preventDefault()
        const url = $(this).attr("href");

        if(!!url){
            getUFFilter(url);
        }
    })

    $(".btnEditUF").on("click", function(){
        const id = $(this).attr("id");
        const url = "/uf/edit/" + id;

        AppUsage.loadModal(url, modalObject, '800px', function(){
            $("#editFormUF").on("submit", function(e){
                e.preventDefault();

                formUF(id);
            })

        });
    });

    $(".btnDeleteUF").on("click", function(){
        const id = $(this).attr("id");
        const url = "/uf/delete/" + id;

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
                    getUFFilter();
                })
            }
        })
    });
}

const getUFFilter = function(url){
    let form = $("#formSearchUF").serialize();

    $.ajax({
        type: "GET",
        url: typeof url !== "undefined" ? url : "/uf/",
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

const formUF = function(id){
    let form = typeof id == "undefined" ? '#addFormUF' : "#editFormUF";
    let url =  typeof id == "undefined" ? '/uf/store' : `/uf/update/${id}`
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
            
            getUFFilter()
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
    habilitaBotoes, 
    habilitaEventos,
    changeTitle,
}