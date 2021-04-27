$(function(){
    habilitaBotoes()
    habilitaEventos()
});

const modalObject = "#nivel1";

const habilitaEventos = function(){
    $("#searchUser").on('submit', function(e){
        e.preventDefault();
        let form = $(this).serialize();

        getUsersFilter(form);
    });

    $("#clear_filter_user").on('click', function(){
        let selects = $("#role, #setor");
        selects.select2('destroy').val("").select2();
    });
}

const habilitaBotoes = function(){
    $("#cadastrarUser").on("click", function(){
        let url = '/users/create'
        AppUsage.loadModal(url, modalObject, '1000px', function(){
                
        })
    })
}

const getUsersFilter = function(searchformData){
    let gridUser = "#gridUsers";

    $.ajax({
        type: "GET",
        url: "/users/",
        data: searchformData,
        dataType: "HTML",
        beforeSend:function(){
            AppUsage.loading($(gridUser));
        },
        success: function (response) {
           $(gridUser).html($(response).find(`${gridUser} >`));
            habilitaBotoes();
        }
    });
}



module.exports = {
    habilitaEventos,
    habilitaBotoes,
}