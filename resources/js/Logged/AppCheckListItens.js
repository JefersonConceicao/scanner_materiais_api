$(function(){
    habilitaEventos()
    habilitaBotoes()
})

const grid = "#gridCheckListItem";
const modalObject = "#nivel1";

const changeTitle = function(){
    document.title = 'BT | Checklist de Itens';
}

const habilitaEventos = function(){
    $("#formSearchCheckListItens").on("submit", function(e){
        e.preventDefault();

        getCheckListItens();
    }); 
}

const habilitaBotoes = function(){
    $(grid + " .pagination > li > a").on("click", function(e){
        e.preventDefault();
        const url = $(this).attr("href");

        if(!!url){
            getCheckListItens(url);
        }
    })

    $("#addCheckListItem").on("click", function(){
        const url = '/checkListItens/create';

        AppUsage.loadModal(url, modalObject, '50%', function(){
            $("#addFormCheckListItem").on("submit", function(e){
                e.preventDefault()

                formCheckListItem();
            })
        })
    })
    
    $(".btnEditChecklistItem").on("click", function(){
        const id = $(this).attr("id");
        const url = '/checkListItens/edit/' + id;

        AppUsage.loadModal(url, modalObject, '50%', function(){
            $("#editFormCheckListItem").on("submit", function(e){
                e.preventDefault()

                formCheckListItem(id);
            }) 
        });
    });

    $(".btnDeleteChecklistItem").on("click", function(){
        const id = $(this).attr("id");
        const url = '/checkListItens/delete/' + id;

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
                    getCheckListItens();
                })
            }
        })
    });

}   

const formCheckListItem = function(id){
    let form = typeof id == "undefined" ? '#addFormCheckListItem' : "#editFormCheckListItem";
    let url =  typeof id == "undefined" ? '/checkListItens/store' : `/checkListItens/update/${id}`
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
            
            getCheckListItens()
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

const getCheckListItens = function(url){
    let form = $("#formSearchCheckListItens").serialize();

    $.ajax({
        type: "GET",
        url: typeof url !== "undefined" ? url : "/checkListItens/",
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
    habilitaBotoes,
    habilitaEventos
}