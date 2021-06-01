$(function(){
    habilitaBotoes();
    habilitaEventos();
});

const modalObject = "#nivel1";
const grid = "#gridCategoriaInstrumentos";

const changeTitle = function(){
    document.title = "BT | Categoria do Instrumento"
}

const habilitaEventos = function(){
    $("#formSearchCategoriaInstrumento").on("submit", function(e){
        e.preventDefault()

        getCategoriaInstrumento();
    }); 
}

const habilitaBotoes = function(){
    AppUsage.deleteMultipleRowsHelper(grid, function(){
        $(".deleteALL").on("click", function(){
            const url = '/categoriaInstrumentos/deleteAll'
            const ids = $("tr.row-selected").map(function(index, element){
                return $(element).attr("key");
            });

            AppUsage.deleteMultipleRowsGrid(url, ids, function(){
                getCategoriaInstrumento();  
            })
        });
    })

    $("#addCategoriaInstrumento").on("click", function(){
        const url = '/categoriaInstrumentos/create';

        AppUsage.loadModal(url, modalObject, '70%', function(){
            $("#addFormCategoriaInstrumento").on("submit", function(e){
                e.preventDefault();

                formCategoriaInstrumento();
            });     
        });
    })

    $(".btnEditCatInstrumento").on("click", function(){
        const id = $(this).attr("id");
        const url = '/categoriaInstrumentos/edit/' + id;

        AppUsage.loadModal(url, modalObject, '70%', function(){
            $("#editFormCategoriaInstrumento").on("submit", function(e){
                e.preventDefault();

                formCategoriaInstrumento(id);
            }); 
        });
    });

    $(".btnDeleteCatInstrumento").on("click", function(){
        const id = $(this).attr("id");
        const url = '/categoriaInstrumentos/delete/' + id;

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
                    getCategoriaInstrumento();
                })
            }
        })
    })
}

const getCategoriaInstrumento = function(){
    let form = $("#formSearchCategoriaInstrumento").serialize();

    $.ajax({
        type: "GET",
        url: typeof url !== "undefined" ? url : "/categoriaInstrumentos/",
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

const formCategoriaInstrumento = function(id){
    let form = typeof id == "undefined" ? '#addFormCategoriaInstrumento' : "#editFormCategoriaInstrumento";
    let url =  typeof id == "undefined" ? '/categoriaInstrumentos/store' : `/categoriaInstrumentos/update/${id}`
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
            
            getCategoriaInstrumento()
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