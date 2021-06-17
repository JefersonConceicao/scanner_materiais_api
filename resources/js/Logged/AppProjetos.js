$(function(){
    habilitaEventos()
    habilitaBotoes()
})

const modalObject = "#nivel1";
const grid = "#gridProjetos";

const changeTitle = function(){
    document.title = 'BT | Projetos'
}

const habilitaEventos = function(){
    $("#searchFormProjetos").on("submit", function(e){
        e.preventDefault();

        getProjetosFilter();
    }); 
}

const habilitaBotoes = function(){
    $(grid + " .pagination  > li > a").on("click", function(e){
        e.preventDefault();

        const url = $(this).attr("href");

        if(!!url){
            getProjetosFilter(url);
        }
    });

    $("#addProjeto").on("click", function(){
        const url = "/projetos/create";

        AppUsage.loadModal(url, modalObject, '80%', function(){
            $("#addFormProjetos").on("submit", function(e){
                  
            })
        }); 
    })

    $(".btnEditProjeto").on("click", function(){
        const id = $(this).attr("id");
        const url = "/projetos/edit/" + id;

        AppUsage.loadModal(url, modalObject, '50%', function(){
            
        });
    });

    $(".btnViewProjeto").on("click", function(){
        const id = $(this).attr("id");
        const url = '/projetos/view/' + id;

        AppUsage.loadModal(url, modalObject, '40%', function(){

        });
    }); 
}

const getProjetosFilter = function(url){
    const form = $("#searchFormProjetos").serialize();

    $.ajax({
        type: "GET",
        url: typeof url !== "undefined" ? url : "/projetos/",
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

const formProjetos = function(){
    let form = typeof id == "undefined" ? '#addFormUF' : "#editFormUF";
    let url =  typeof id == "undefined" ? '/projetos/store' : `/projetos/update/${id}`
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
    changeTitle,
    habilitaEventos,
    habilitaBotoes
}

