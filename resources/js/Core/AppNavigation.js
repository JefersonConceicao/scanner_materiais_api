$(function(){
    setOptions();
})

const listMenu = $('.main-sidebar > .sidebar > .sidebar-menu > li');
const listMenuGroups = $('.main-sidebar > .sidebar > .sidebar-menu > li.treeview')

const verifySubmenuOpen = function(){   
    //verifica qual menu está aberto 
    return listMenu.filter((index, value) => ( 
        value.classList.contains('active')
    ))  
}

const setOptions = function(){
    listMenuGroups.on('click', function(e){
        e.preventDefault();

        if($(this).hasClass('menu-open')){
            return null; 
        }else{
            let optionsMenu = $(this).find('li > a').addClass("targetChange");

            changeScreen(optionsSubMenu, optionsMenu);
        }
    })
}

const changeScreen = function(optionsMenu){
   $('.targetChange').on('click', function(){
        let url = $(this).prop('href');
     
   })
}   


module.exports = {
    verifySubmenuOpen,
    setOptions,
}