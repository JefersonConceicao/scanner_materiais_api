$(function(){
    habilitaBotoes();
    habilitaEventos();
})

const modalObject = "#nivel1";
const grid = "#gridZT";

const changeTitle = function(){
    document.title = 'BT | Zonas Turísticas';
}

const habilitaEventos = function(){
    $("#formSearchZT").on("submit", function(e){
        e.preventDefault();

        getZTFilter();
    });

    $("#addZT").on("click", function(){
        const url = '/zonasTuristicas/create';

        AppUsage.loadModal(url, modalObject, '800px', function(){
            $("#addFormZT").on("submit", function(e){
                e.preventDefault();

                formZT()
            });
        })
    })
}   

const habilitaBotoes = function(){
    $(grid + " .pagination > li > a").on("click", function(e){
        e.preventDefault()
        const url = $(this).attr("href");

        if(!!url){
            getZTFilter(url);
        }
    })
}

const getZTFilter = function(url){
    let form = $("#formSearchZT").serialize();

    $.ajax({
        type: "GET",
        url: typeof url !== "undefined" ? url : "/zonasTuristicas/",
        data: form,
        dataType: "HTML",
        beforeSend:function(jqXHR, settings){
            AppUsage.loading($(grid));
        },
        success: function (response) {
           $(grid).html($(response).find(`${grid} >`));
            habilitaBotoes();
        }
    });
}

const formZT = function(id){
    let form = typeof id == "undefined" ? '#addFormZT' : "#editFormZT";
    let url =  typeof id == "undefined" ? '/zonasTuristicas/store' : `/zonasTuristicas/update/${id}`
    let type = typeof id == "undefined" ? 'POST' : 'PUT';

    $.ajax({
        type,
        url,
        data: $(form).serialize(),
        dataType: "JSON",
        beforeSend:function(){
            $(form + ".btnSubmit").prop("disabled", true).html(`
                <i class="faf a-spinner fa-spin"> </i> Carregando...
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
        },
        error:function(jqXHR, textStatus, errorThrown){
            if(!!jqXHR.responseJSON){
                let errorsRequest = jqXHR.responseJSON.errors;
                AppUsage.showMessagesValidator(form, errorsRequest)
            }
        },
        complete:function(){
            $(form + ".btnSubmit").prop("disabled", true).html(`
                Salvar
            `)
        }
    });
}

module.exports = {
    changeTitle,
    habilitaBotoes,
    habilitaEventos,
}