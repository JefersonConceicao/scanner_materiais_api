const { default: Swal } = require("sweetalert2");

$(function(){
    habilitaBotoes()
    habilitaEventos()
})

const grid = "#gridCheckListEstrutura";
const modalObject = "#nivel1";

const changeTitle = function(){
    document.title = 'BT | CheckList de Estruturas'
}

const habilitaEventos = function(){
    $("#formSearchCheckListEstrutura").on("submit", function(e){
        e.preventDefault()
        getCheckListEstruturaFilter()
    });
}

const habilitaBotoes = function(){
    $("#addCheckListEstrutura").on("click", function(e){
        const url = '/checkListEstruturas/create';

        AppUsage.loadModal(url, modalObject, '50%', function(){
            $("#addFormCheckListEstrutura").on("submit", function(e){
                e.preventDefault();
                formCheckListEstrutura();
            })

            //ABRE MODAL PARA ADICIONAR MODELO
            $("#addModeloInCheckEstrutura").on("click", function(){
                const url = '/checkListModelos/create';

                AppUsage.loadModal(url, "#nivel2", '40%', function(){
    
                    //REUTILIZANDO MÉTODO DE CHECKLIST MODELOS
                    $("#addCheckListModelo").on("submit", function(e){ 
                        e.preventDefault();

                        AppCheckListModelos.formCheckListModelos(undefined, "#nivel2"); 
                    }); 
                })
            });
        })
    })

    $(".btnEditCheckListEstrutura").on("click", function(){
        const id = $(this).attr("id");
        const url = "/checkListEstruturas/edit/" + id;

        AppUsage.loadModal(url, modalObject, '50%', function(){
            $("#editFormCheckListEstrutura").on("submit", function(e){
                e.preventDefault();

                formCheckListEstrutura(id);
            })
        })
    })

    $(".btnDeleteCheckListEstrutura").on("click", function(){
        const id = $(this).attr("id");
        const url = "/checkListEstruturas/delete/" + id;

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
                    getCheckListEstruturaFilter();  
                });
            }
        });
    })
}   

const formCheckListEstrutura = function(id){
    let form = typeof id == "undefined" ? '#addFormCheckListEstrutura' : "#editFormCheckListEstrutura";
    let url =  typeof id == "undefined" ? '/checkListEstruturas/store' : `/checkListEstruturas/update/${id}`
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
            
            getCheckListEstruturaFilter()
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

const getCheckListEstruturaFilter = function(url){
    let form = $("#formSearchCheckListEstrutura").serialize();

    $.ajax({
        type: "GET",
        url: typeof url !== "undefined" ? url : "/checkListEstruturas/",
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
    habilitaBotoes,
}