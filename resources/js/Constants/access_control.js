//ESTE SCRIPT TEM COMO RESPONSABILIDADE OCULTAR/REMOVER TODOS OS ELMENTOS QUE NÃO CONTÉM A PERMISSÃO DE ACESSO
//DO USUÁRIO

$(function(){
    setPermissionsElements();
    verifyContainSubmenu();
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

const verifyContainSubmenu = function(){
    let menuWithSubMenu = $(".sidebar  li.treeview");

    menuWithSubMenu.each(function(index, element){
        let $thisElement = $(element);

        if($(element).find('.treeview-menu >').length == 0){
            $thisElement.remove();
        }
    })
}

$(document).ajaxSuccess(function(){
    setPermissionsElements();
    verifyContainSubmenu();
})

