$(function(){
    habilitaEventos()
    habilitaBotoes()
})

const modalObject = "#nivel1";
const grid = "#gridTT"

const changeTitle = function(){
    document.title = " BT | Territórios Turísticos"; 
}

const habilitaEventos = function(){
    $("#searchFilterTT").on("submit", function(e){
        e.preventDefault()
        getTTFilter()
    })

    $("#addTT").on("click", function(){
        const url = '/territoriosTuristicos/create'

        AppUsage.loadModal(url, modalObject, '800px', function(){
            $("#addFormTT").on("submit", function(e){
                e.preventDefault()

                formTT()
            })
        });
    })
}

const habilitaBotoes = function(){
    AppUsage.deleteMultipleRowsHelper(grid, function(){
        $(".deleteALL").on("click", function(){
            const url = '/territoriosTuristicos/deleteAll'
            const ids = $("tr.row-selected").map(function(index, element){
                return $(element).attr("key");
            });

            AppUsage.deleteMultipleRowsGrid(url, ids, function(){
                getTTFilter()
            })
        });
    });

    $(".editTT").on("click", function(){
        const id = $(this).attr("id")
        const url = '/territoriosTuristicos/edit/' + id;

        AppUsage.loadModal(url, modalObject, '800px', function(){
            $("#editFormTT").on("submit", function(e){
                e.preventDefault();

                formTT(id);
            })
        })
    })

    $(".deleteTT").on("click", function(){
        const id = $(this).attr("id");
        const url = '/territoriosTuristicos/delete/' + id;
        
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
                    getTTFilter();
                })
            }
        })
    })
}

const getTTFilter = function(){
    let form = $("#searchFilterTT").serialize();

    $.ajax({
        type: "GET",
        url: typeof url !== "undefined" ? url : "/territoriosTuristicos/",
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

const formTT = function(id){
    let form = typeof id == "undefined" ? '#addFormTT' : "#editFormTT";
    let url =  typeof id == "undefined" ? '/territoriosTuristicos/store' : `/territoriosTuristicos/update/${id}`
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

            getTTFilter()
        },
        error:function(jqXHR, textstatus, error){
            if(!!jqXHR.responseJSON.errors){
                const errors = jqXHR.responseJSON.errors;

                AppUsage.showMessagesValidator(form, errors);
            }

        },
        complete:function(){
            $(form + " .btnSubmit").prop("disabled", true).html(`
                <i class="fa fa-spinner fa-spin"> </i> Carregando...
            `)   
        },
    });
}

module.exports = {
    habilitaEventos,
    habilitaBotoes,
    changeTitle,
}