$(function(){
    habilitaBotoes()
    habilitaEventos()
})

const modalObject = "#nivel1"

const changeTitle = function(){
    document.title = "Admin | Grupos";
}

const habilitaEventos = function(){
    $("#addRole").on("click", function(){       
        const url = '/roles/create'

        AppUsage.loadModal(url, modalObject, '800px', function(){
            $("#formAddGroup").on('submit', function(e){
                e.preventDefault()

                formRoles()
            })
        })
    })

    $("#filterSearchRole").on("submit", function(e){
        e.preventDefault()
        
        loadConsRoles();
    })
}   

const habilitaBotoes = function(){
    $(".editRole").on("click", function(){
        const id = $(this).attr("id");
        const url = '/roles/edit/' + id;

        AppUsage.loadModal(url, modalObject, '800px', function(){
            $("#formEditGroup").on('submit', function(e){
                e.preventDefault()

                formRoles(id)
            })
        });
    })

    $(".deleteRole").on("click", function(){
        const id = $(this).attr('id')
        const url = '/roles/delete/' + id;

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
                    loadConsRoles()
                })
            }
        })
    })
}

const loadConsRoles = function(){
    const url = "/roles/"
    const grid = "#gridRoles"
    const formSearch = "#filterSearchRole"

    $.ajax({
        type: "GET",
        url,
        data: $(formSearch).serialize(),
        dataType: "HTML",
        beforeSend:function(){
            AppUsage.loading($(grid));
        },
        success: function (response) {
            $(grid).html($(response).find(`${grid} >`))
            habilitaBotoes()
        }
    });

}

const formRoles = function(id){
    let url = typeof id === "undefined" ? "/roles/store"  : `/roles/update/${id}`
    let type = typeof id === "undefined" ? "POST" : "PUT"
    let form = typeof id === "undefined" ? "#formAddGroup" : "#formEditGroup"

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
                },
            });

            loadConsRoles()
        },
        complete:function(){
            $(form + " .btnSubmit").prop("disabled", false).html(`
                Salvar
            `)
        },
        error:function(jqXHR, textstatus, error){
            if(!!jqXHR.responseJSON.errors){
                const errors = jqXHR.responseJSON.errors;

                AppUsage.showMessagesValidator(form, errors)
            }

        }
    });
}


module.exports = {
    habilitaBotoes,
    habilitaEventos,
    changeTitle,
}