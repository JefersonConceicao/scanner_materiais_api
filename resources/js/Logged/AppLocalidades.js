$(function(){
    habilitaEventos()
    habilitaBotoes()
});

const modalObject = "#nivel1";
const grid = "#gridLocalidade";

const changeTitle = function(){
    document.title = "BT | Localidades";
}

const habilitaEventos = function(){
    $("#formSearchFilterLocalidades").on("submit", function(e){
        e.preventDefault();
        getLocalidadesFilter();
    });
}

const habilitaBotoes = function(){ //FUNÇÃO RESPONSÁVEL DE HABILITAR OS EVENTOS DO MÓDULO
    $("#addLocalidade").on("click", function(){
        const url = "/localidades/create";
    
        AppUsage.loadModal(url, modalObject, '92%', function(){
            $("#addFormLocalidade").on("submit", function(e){
                e.preventDefault();
                const dataAniversario = $("#form_add_localidade_Aniversario");
                const dataPadroeiro = $("#form_add_localidade_dia_padroeiro");

                if(!!dataAniversario.val() && !moment(dataAniversario.val(), 'DD MM').isValid()){
                    dataAniversario.parent().find('.error_feedback').html(
                        `<p class="required"> Data inválida </p> 
                    `);
                    
                    return false;
                }

                if(!!dataPadroeiro.val() && !moment(dataPadroeiro.val(), 'DD MM').isValid()){
                    dataPadroeiro.parent().find('.error_feedback').html(
                        `<p class="required"> Data inválida </p>`
                    );
                    
                    return false;
                }

                formLocalidade();
            })
        });
    });

    $(".btnEditLocalidade").on("click", function(){
        const id = $(this).attr("id");
        const url = `/localidades/edit/${id}`

        AppUsage.loadModal(url, modalObject, '92%', function(){
            $(modalObject + " input[type='checkbox']").on('change', function(){
                if($(this).is(':checked')){
                    $(this).val("S");
                }else{
                    $(this).val("N");
                }
            })

            $("#editFormLocalidade").on("submit", function(e){
                e.preventDefault();

                const dataAniversario = $("#form_edit_localidade_Aniversario");
                const dataPadroeiro = $("#form_edit_localidade_dia_padroeiro");

                if(!!dataAniversario.val() && !moment(dataAniversario.val(), 'DD MM').isValid()){
                    dataAniversario.parent().find('.error_feedback').html(
                        `<p class="required"> Data inválida </p>`
                    );
                    
                    return false;
                }

                if(!!dataPadroeiro.val() && !moment(dataPadroeiro.val(), 'DD MM').isValid()){
                    dataPadroeiro.parent().find('.error_feedback').html(
                        `<p class="required"> Data inválida </p>`
                    );
                    
                    return false;
                };
                formLocalidade(id);
            });
        });
    });

    $(".btnDetailsLocalidade").on("click", function(){
        const id = $(this).attr("id");
        const url = `/localidades/details/${id}`

        AppUsage.loadModal(url, "#nivel1", '95%', function(){
            //Executa eventos de modulos dentro do modal
            AppLocalidadesDistancia.habilitaEventos(id);
            AppLocalidadesDistancia.habilitaBotoes(id);

            AppLocalidadesInfraestrutura.habilitaEventos(id);
            AppLocalidadesInfraestrutura.habilitaBotoes(id);

            AppLocalidadesEventoFesta.habilitaEventos(id);
            AppLocalidadesEventoFesta.habilitaBotoes(id);
        });
    })

    $(grid + " .pagination > li > a").on("click", function(e){
        e.preventDefault();
        const url = $(this).attr("href");

        if(!!url){
            getLocalidadesFilter(url);
        }
    })
}

const getLocalidadesFilter = function(url){
    const form = $("#formSearchFilterLocalidades").serialize();

    $.ajax({
        type: "GET",
        url: typeof url !== "undefined" ? url : "/localidades/",
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

const formLocalidade = function(id){
    let form = typeof id == "undefined" ? '#addFormLocalidade' : "#editFormLocalidade";
    let url =  typeof id == "undefined" ? '/localidades/store' : `/localidades/update/${id}`
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
            
            getLocalidadesFilter()
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
    habilitaBotoes,
}