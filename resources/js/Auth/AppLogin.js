$(function(){
    habilitaBotoes();
    habilitaEventos();
})

const loginFacebook = function(){
    FB.getLoginStatus(function(response){
        console.log(response);
    })
}

const habilitaEventos = function() {
    $("#seePass").on('click', function(){
        let passwordInputElement = $("input[name='password']");
        let openEyedIcon = "glyphicon-eye-open"
        let closeEyedIcon = "glyphicon-eye-close";
        
        if(passwordInputElement.attr('type') == "password"){
            passwordInputElement.attr("type","text");
        }else{
            passwordInputElement.attr("type", "password");
        }

        if($(this).hasClass(openEyedIcon)){
            $(this).removeClass(openEyedIcon).addClass(closeEyedIcon);
        }else{
            $(this).removeClass(closeEyedIcon).addClass(openEyedIcon);
        }
    }); 
}
const habilitaBotoes = function(){} 

module.exports = {  
    habilitaBotoes,
    habilitaEventos,
    loginFacebook,
}