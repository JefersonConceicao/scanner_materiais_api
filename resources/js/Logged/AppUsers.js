$(function(){
    habilitaBotoes()
    habilitaEventos()
});

const habilitaEventos = function(){
    $("#searchUser").on('submit', function(e){
        e.preventDefault();
        let form = $(this).serialize();

        getUsersFilter(form);
    });

}

const habilitaBotoes = function(){
    $("#cadastrarUser").on("click", function(){
        let url = '/users/create'
        AppUsage.loadModal(url, function(){
             
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