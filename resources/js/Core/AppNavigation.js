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
            let module = $(this).find('a').attr('module');

            setActive($(this));
            getNewScreen(url, module);
        }
    })
}

const setOptionsSubMenu = function(){
    listMenuGroups.on('click', function(e){
        let url = $(this).attr('href');
        let module = $(this).attr('module');

        setActive($(this));
        getNewScreen(url, module);
    })
}

const setActive = function(element){
    let liSubMenu = listMenuGroups.parent();

    if(element.is('li')){
        if(liSubMenu.hasClass("active")){
            liSubMenu.removeClass("active");
        }

        if(!element.hasClass('treeview')){
           let menuOpen = listMenu.filter((index, valueElement) => {
                if($(valueElement).hasClass("menu-open")){
                    return $(valueElement);
                }
           })

           menuOpen.removeClass('menu-open');
           menuOpen.find('.treeview-menu').hide();
        }

        if(listMenu.hasClass("active")){
            listMenu.removeClass("active");
        }

        element.addClass("active");
    }else{
        let subMenuToRemove = listMenu.filter((index, valueElement) => {
            if(!$(valueElement).hasClass('treeview active')){
                return $(valueElement);
            }
        })

        subMenuToRemove.removeClass('active');
        if(liSubMenu.hasClass("active")){
            liSubMenu.removeClass("active");
        }

        element.parent().addClass("active");
    }
}

const loadingNavigation = function(inicio,  fim, isComplete = false){
    //Calcula tempo de carregamento;
    const msTimeLoading = fim - inicio; 

    //Configura container body

    $("#containerLoadingBar").show(); //Inicia barra de carregamento

    let progressBar = $("#progressLoadingBar");
    let width = !isComplete ? 1 : 93;

    let idInterval = setInterval(function(){
        if(width >= 100){
            clearInterval(idInterval);  
            width = 1;
            
            $("#containerLoadingBar").hide(); 

        }else{
            width++
            progressBar.css({
                width:`${width}%`,
                backgroundColor: width > 80 ? '#337ab7' : '#e91313'  
            })

            if(!isComplete && width == 93){
                clearInterval(idInterval);
            }

            if(isComplete){
                width++;
            }
        }
    }, msTimeLoading)   
}

const getNewScreen = function(url, module){
    const elementWrapper = $('.content-wrapper');

    $.ajax({
        type: "GET",
        url,
        dataType: "HTML",
        start_time: new Date().getTime(),
        beforeSend:function(jqXHR, settings){
            $("#contentLoading").show();
            loadingNavigation(this.start_time, new Date().getTime());
        },
        success: function (response) {
            changeURL(url);

            elementWrapper.html(response);
            AppUsage.initializeDataTable();
            AppUsage.loadLibs();

            if(module != "no_module"){
                modulo = require('../Logged/'+module);
        
                if(!!modulo.habilitaBotoes && !!modulo.habilitaEventos){
                    !!modulo.changeTitle && modulo.changeTitle() ;
                    modulo.habilitaBotoes();
                    modulo.habilitaEventos();
                }
            }
        },
        error:function(err){
            console.log(err);
        },
        complete:function(){
            loadingNavigation(this.start_time, new Date().getTime(), true);
            $("#contentLoading").hide();
        },
    });
}

const changeURL = function(url){ //void
    history.pushState({}, "", url);
}

module.exports = {
    setOptionsSubMenu,
    loadingNavigation,
}