$(function(){
    habilitaBotoes();
    habilitaEventos();
})

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
const habilitaBotoes = () => {} 

module.exports = {  
    habilitaBotoes,
    habilitaEventos,
}