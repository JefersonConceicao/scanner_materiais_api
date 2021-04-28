$(function(){
    setOptionsMenu();
    setOptionsSubMenu();
})

const listMenu = $('.main-sidebar > .sidebar > .sidebar-menu > li');
const listMenuGroups = $('.main-sidebar > .sidebar > .sidebar-menu > li.treeview > .treeview-menu > li > a').addClass('targetSubMenu');

const setOptionsMenu = function(){
    listMenu.on('click', function(e){
        e.preventDefault();

        if(!$(this).hasClass('treeview')){
            let url = $(this).find('a').attr('href');

            setActive($(this));
            getNewScreen(url);
        }
    })
}

const setOptionsSubMenu = function(){
    listMenuGroups.on('click', function(e){
        let url = $(this).attr('href');

        setActive($(this));
        getNewScreen(url);
    })
}

const setActive = function(element){
    if(element.hasClass('active')){
        return;
    }

    //VERIFICA E REMOVE QUALQUER LI ATIVA
    let activeList = listMenu.find('.active');
    let subMenuActive = listMenuGroups.parent().find('.active');

    activeList.removeClass('active');
    subMenuActive.removeClass('active');

    element.parent().addClass("active");
}

const getNewScreen = function(url){
    const elementWrapper = $('.content-wrapper');

    $.ajax({
        type: "GET",
        url,
        dataType: "HTML",
        beforeSend:function(){
            AppUsage.loading(elementWrapper);
        },
        success: function (response) {
            elementWrapper.html(response);
        },
        error:function(err){
            console.log(err);
        },
    });
}

module.exports = {
    setOptionsSubMenu,
}