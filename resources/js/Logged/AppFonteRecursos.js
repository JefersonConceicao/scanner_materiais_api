const { default: Swal } = require("sweetalert2");

$(function(){
    habilitaBotoes()
    habilitaEventos()
});

const modalObject = "#nivel1";
const grid = "#gridFonteRecursos";

const changeTitle = function(){
    document.title = "BT | Fonte de Recursos";
}

const habilitaEventos = function(){
    $("#formSearchFonteRecursos").on("submit", function(e){
        e.preventDefault()
        getFonteRecursos()
    })
}

const habilitaBotoes = function(){
    $(grid + " .pagination > li > a").on("click", function(e){
        e.preventDefault();
        
        const url = $(this).attr("href");
        
        if(!!url){
            getFonteRecursos(url);
        }
    });

    $("#addFonteRecurso").on("click", function(){
        const url = '/fonteRecursos/create';

        AppUsage.loadModal(url, modalObject, '60%', function(){
            $("#formAddFonteRecurso").on("submit", function(e){
                e.preventDefault();
                formFonteRecurso();
            });
        })
    })

    $(".btnEditFonteRecurso").on("click", function(){
        const id = $(this).attr("id");
        const url = '/fonteRecursos/edit/' + id;

        AppUsage.loadModal(url, modalObject, '60%', function(){
            $("#formEditFonteRecurso").on("submit", function(e){
                e.preventDefault()
                formFonteRecurso(id)
            });
        })
    }); 

    $(".btnDeleteFonteRecurso").on("click", function(){
        const id = $(this).attr("id");
        const url = '/fonteRecursos/delete/' + id;

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
                    getFonteRecursos()       
                })
            }
        });
    }); 
}

const getFonteRecursos = function(url){
    const form = $("#formSearchFonteRecursos").serialize();

    $.ajax({
        type: "GET",
        url: typeof url !== "undefined" ? url : "/fonteRecursos/",
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

const formFonteRecurso = function(id){
    let url = typeof id === "undefined" ? '/fonteRecursos/store' : `/fonteRecursos/update/${id}`
    let type = typeof id === "undefined" ? "POST" : "PUT"
    let form = typeof id === "undefined" ? "#formAddFonteRecurso" : "#formEditFonteRecurso"

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

            getFonteRecursos()
        },
        error:function(jqXHR, textstatus, error){
            if(!!jqXHR.responseJSON.errors){
                let errors = jqXHR.responseJSON.errors
                AppUsage.showMessagesValidator(form, errors);
            }
        },
        complete:function(){
            $(form + " .btnSubmit").prop("disabled", false).html(`
                Salvar
            `)
        },
    });
}

module.exports = {
    changeTitle,
    habilitaEventos,
    habilitaBotoes
}