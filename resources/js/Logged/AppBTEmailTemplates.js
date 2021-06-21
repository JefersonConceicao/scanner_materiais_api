$(function(){
    habilitaEventos();
    habilitaBotoes();
});

const modalObject = "#nivel1";
const grid = "#gridBTEmailTemplates";

const changeTitle = function(){
    document.title = 'BT | Templates E-mail'
}

const habilitaEventos = function(){
    $(".back-to-settings").on("click", function(e){
        e.preventDefault(); 
                
        const url = $(this).attr("href");
        const module = $(this).attr("requestjs");

        AppNavigation.getNewScreen(url, module);
    })

    $("#searchFormTemplatesEmail").on("submit", function(e){
        e.preventDefault()
        getBTEmailTemplates();
    })
}

const habilitaBotoes = function(){
    $("#addBTEmailTemplate").on("click", function(){
        const url = '/btEmailTemplates/create';

        AppUsage.loadModal(url, modalObject, '50%', function(){
            $("#addFormEmailTemplate").on("submit", function(e){
                e.preventDefault()
                formBTEmailTemplates()
            });
        }); 
    })

    $(".btnEditEmailTemplate").on("click", function(){
        const id = $(this).attr("id");
        const url = '/btEmailTemplates/edit/' + id;

        AppUsage.loadModal(url, modalObject, '50%', function(){
            $("#editFormEmailTemplate").on("submit", function(e){
                e.preventDefault()
                formBTEmailTemplates(id)
            })
        })
    })

    $(".btnDeleteEmailTemplate").on("click", function(){
        const id = $(this).attr("id");
        const url = '/btEmailTemplates/delete/' + id;

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
            AppUsage.deleteForGrid(url, function(){
                if(result.isConfirmed){
                    getBTEmailTemplates();
                }
            })
        });
    })
}

const formBTEmailTemplates = function(id){
    let form = typeof id == "undefined" ? '#addFormEmailTemplate' : "#editFormEmailTemplate";
    let url =  typeof id == "undefined" ? '/btEmailTemplates/store' : `/btEmailTemplates/update/${id}`
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

            getBTEmailTemplates();
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

const getBTEmailTemplates = function(){
    let form = $("#searchFormTemplatesEmail").serialize();

    $.ajax({
        type: "GET",
        url: typeof url !== "undefined" ? url : "/btEmailTemplates/",
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
    habilitaBotoes
}

