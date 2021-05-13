//ESTE SCRIPT TEM COMO RESPONSABILIDADE OCULTAR/REMOVER TODOS OS ELMENTOS QUE NÃO CONTÉM A PERMISSÃO DE ACESSO
//DO USUÁRIO
$(function(){
    setPermissionsElements();
})

var permissions = JSON.parse(arrayPermissions);

const setPermissionsElements = function(){
    if(!!permissions && permissions.length > 0){
        let elementsWithAc;

        permissions.forEach((value, index) => {
            elementsWithAc = $(`[bt_ac]`); 
        })

        elementsWithAc.each(function(){
            let element = $(this);
            let acLI = element.attr("bt_ac") !== "zxFQ" ? element.attr("bt_ac") : null;

            if(!!acLI){ 
                if($.inArray(acLI, permissions) == -1){
                    $(this).remove();
                }
            }
        })
    }
} 

$(document).ajaxSuccess(function(){
    setPermissionsElements();
})

