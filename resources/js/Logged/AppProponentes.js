const { default: Swal } = require("sweetalert2");

$(function(){
    habilitaEventos()
    habilitaBotoes()
})

const grid = "#gridProponentes";
const modalObject = "#nivel1";

const changeTitle = function(){
    document.title = 'BT | Proponentes';
}

const habilitaEventos = function(){
    $("#searchFilterProponentes").on("submit", function(e){
        e.preventDefault()
        getProponentesFilter()
    })
}

const habilitaBotoes = function(){
    $(grid + " .pagination > li > a").on("click", function(e){
        e.preventDefault()

        const url = $(this).attr("href");

        if(!!url){
            getProponentesFilter(url);
        }
    })

    $("#addProponente").on("click", function(){
        const url = '/proponentes/create';

        AppUsage.loadModal(url, modalObject, '65%', function(){
            settingsInputsProponentes();

            $("#addFormProponentes").on("submit", function(e){
                e.preventDefault()
                formProponentes()
            });
        })
    });

    $(".btnEditProponente").on("click", function(){
        const id = $(this).attr("id");
        const url = '/proponentes/edit/' + id;

        AppUsage.loadModal(url, modalObject, '65%', function(){
            $("#editFormProponentes").on("submit", function(e){
                e.preventDefault()
                formProponentes(id)
            })
        }); 
    })

    $(".btnDeleteProponente").on("click", function(){
        const id = $(this).attr("id");
        const url = '/proponentes/delete/' + id;

        Swal.fire({
            title: 'Deseja realmente excluir o registro ?',
            text: 'Esta ação é irreversível',
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
                    getProponentesFilter();
                });
            }
        });
    });
}

const formProponentes = function(id){
    let form = typeof id == "undefined" ? '#addFormProponentes' : "#editFormProponentes";
    let url =  typeof id == "undefined" ? '/proponentes/store' : `/proponentes/update/${id}`
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
            
            getProponentesFilter()
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

const getProponentesFilter = function(url){
    const form = $("#searchFilterProponentes").serialize();

    $.ajax({
        type: "GET",
        url: typeof url !== "undefined" ? url : "/proponentes/",
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

const settingsInputsProponentes = function(){
      //ALTERA LABEL E MASCARA DO CAMPO CPF/CNPJ E RAZÃO SOCIAL
      $(modalObject + " select[name='pessoa']").on("change", function(){
        const element = $(this); 
        const labelChangeCNPJ = $(modalObject + " label[for='cnpj_cpf']") 
        const labelChangeRazao =  $(modalObject + " label[for='nome_proponente']") 

        if(element.val() == "F"){
           labelChangeCNPJ.text("CPF");
           labelChangeRazao.text("Nome do Proponente");

            $(modalObject + " input[name='cnpj_cpf']")
                .removeClass("cnpjcpf cnpj")
                .addClass("cpf");    
        }else{
            labelChangeCNPJ.text("CNPJ")
            labelChangeRazao.text("Razão Social")

            $(modalObject + " input[name='cnpj_cpf']")
                .removeClass("cnpjcpf cpf")
                .addClass("cnpj");
        }

        AppUsage.configMasks();
    })  
    
    $(modalObject + " input[name='cnpj_cpf']").on("blur", function(){
        if(!!$(this).val() && $(this).val().length > 14){
            $.ajax({
                type: "GET",
                url: `/proponentes/getCNPJWSReceita/${$(this).inputmask('unmaskedvalue')}`,
                dataType: "JSON",
                success: function (response) {
                    if(!response.status || response.status != "ERROR"){
                        $(modalObject + ` input[name="nome_proponente"]`).val(response.nome);
                        $(modalObject + ` input[name="e_mail"]`).val(response.email);
                        $(modalObject + ` input[name="cep"]`).val(response.cep);
                        $(modalObject + ` input[name="endereco"]`).val(response.logradouro);
                        $(modalObject + ` input[name="numero"]`).val(response.numero); 
                        $(modalObject + ` input[name="bairro"]`).val(response.bairro);
                        $(modalObject + ` input[name="complemento"]`).val(response.complemento);
                        $(modalObject + ` input[name="telefone01"]`).val(response.telefone);
                    } 
                },
            });
        }      
    })      

    $(modalObject + ` input[name='cep']`).on("blur", function(){
        if(!!$(this).val()){
            const url = `https://viacep.com.br/ws/${$(this).inputmask('unmaskedvalue')}/json/?callback=?`;

            $.getJSON(url, function(response){
               if(!response.erro){
                    $(modalObject + ` input[name="endereco"]`).val(response.logradouro);
                    $(modalObject + ` input[name="bairro"]`).val(response.bairro);
                    $(modalObject + ` input[name="complemento"]`).val(response.complemento);
               }
            })
        }
    })
}

module.exports = {
    changeTitle,
    habilitaEventos,
    habilitaBotoes
}