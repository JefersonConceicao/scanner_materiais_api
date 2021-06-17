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
    //CONFIGURA DATEPICKER ESPECÍFICO PARA DATA INICIAL E FINAL
    const dataInicial = $("#search_form_projetos_dt_inicio")
    const dataFinal = $("#search_form_projetos_dt_fim")

    configRangeDatePicker(dataInicial, dataFinal);

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
            const formDataInicio = $("#form_add_projetos_dt_inicio");
            const formDataFim = $("#form_add_projetos_dt_fim");
    
            $("#form_add_projetos_dt_protocolo").datetimepicker({
                timepicker:false,
                format:'d/m/Y'
            })

            configRangeDatePicker(formDataInicio, formDataFim);

            $("#addFormProjetos").on("submit", function(e){
                e.preventDefault();
                formProjetos();
            })
        }); 
    })

    $(".btnEditProjeto").on("click", function(){
        const id = $(this).attr("id");
        const url = "/projetos/edit/" + id;

        AppUsage.loadModal(url, modalObject, '80%', function(){
            
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

const formProjetos = function(id){
    let form = typeof id == "undefined" ? '#addFormProjetos' : "#editFormProjetos";
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
        success: function(response) {
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
            
            getProjetosFilter()
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

const configRangeDatePicker = function(elementInitialDate, elementEndDate){
    elementInitialDate.datetimepicker({
        timepicker: false,
        format:'d/m/Y',
        onShow: function(date, input){
            this.setOptions({
                maxDate: !!elementEndDate.val() 
                    ? AppHelpers.dateFormatPTToBritanic(elementEndDate.val())
                    : null
            })
        },
    })  

    elementEndDate.datetimepicker({
        timepicker: false,
        format:'d/m/Y',
        onShow: function(date, input){
            this.setOptions({
                minDate: !!elementInitialDate.val() 
                    ? AppHelpers.dateFormatPTToBritanic(elementInitialDate.val())
                    :  null
            })
        },
    })
}

module.exports = {
    changeTitle,
    habilitaEventos,
    habilitaBotoes
}

