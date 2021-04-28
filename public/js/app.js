/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/Auth/AppLogin.js":
/*!***************************************!*\
  !*** ./resources/js/Auth/AppLogin.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  habilitaBotoes();
  habilitaEventos();
});

var habilitaEventos = function habilitaEventos() {
  $("#seePass").on('click', function () {
    var passwordInputElement = $("input[name='password']");
    var openEyedIcon = "glyphicon-eye-open";
    var closeEyedIcon = "glyphicon-eye-close";

    if (passwordInputElement.attr('type') == "password") {
      passwordInputElement.attr("type", "text");
    } else {
      passwordInputElement.attr("type", "password");
    }

    if ($(this).hasClass(openEyedIcon)) {
      $(this).removeClass(openEyedIcon).addClass(closeEyedIcon);
    } else {
      $(this).removeClass(closeEyedIcon).addClass(openEyedIcon);
    }
  });
};

var habilitaBotoes = function habilitaBotoes() {};

module.exports = {
  habilitaBotoes: habilitaBotoes,
  habilitaEventos: habilitaEventos
};

/***/ }),

/***/ "./resources/js/Constants/language_dataTable.js":
/*!******************************************************!*\
  !*** ./resources/js/Constants/language_dataTable.js ***!
  \******************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var portugues = {
  "emptyTable": "Não foi encontrado nenhum registo",
  "loadingRecords": "A carregar...",
  "processing": "A processar...",
  "lengthMenu": "Mostrar _MENU_ registos",
  "zeroRecords": "Não foram encontrados resultados",
  "search": "Procurar:",
  "paginate": {
    "first": "Primeiro",
    "previous": "Anterior",
    "next": "Seguinte",
    "last": "Último"
  },
  "aria": {
    "sortAscending": ": Ordenar colunas de forma ascendente",
    "sortDescending": ": Ordenar colunas de forma descendente"
  },
  "autoFill": {
    "cancel": "cancelar",
    "fill": "preencher",
    "fillHorizontal": "preencher células na horizontal",
    "fillVertical": "preencher células na vertical",
    "info": "Exemplo de Auto Preenchimento"
  },
  "buttons": {
    "collection": "Coleção",
    "colvis": "Visibilidade de colunas",
    "colvisRestore": "Restaurar visibilidade",
    "copy": "Copiar",
    "copyKeys": "Pressiona CTRL ou u2318 + C para copiar a informação para a área de transferência. Para cancelar, clica neste mensagem ou pressiona ESC.",
    "copySuccess": {
      "1": "Uma linha copiada para a área de transferência",
      "_": "%ds linhas copiadas para a área de transferência"
    },
    "copyTitle": "Copiar para a área de transferência",
    "csv": "CSV",
    "excel": "Excel",
    "pageLength": {
      "-1": "Mostrar todas as linhas",
      "1": "Mostrar 1 linha",
      "_": "Mostrar %d linhas"
    },
    "pdf": "PDF",
    "print": "Imprimir"
  },
  "decimal": ",",
  "infoFiltered": "(filtrado num total de _MAX_ registos)",
  "infoThousands": ".",
  "searchBuilder": {
    "add": "Adicionar condição",
    "button": {
      "0": "Construtor de pesquisa",
      "_": "Construtor de pesquisa (%d)"
    },
    "clearAll": "Limpar tudo",
    "condition": "Condição",
    "conditions": {
      "date": {
        "after": "Depois",
        "before": "Antes",
        "between": "Entre",
        "empty": "Vazio",
        "equals": "Igual",
        "not": "Diferente",
        "notBetween": "Não está entre",
        "notEmpty": "Não está vazio"
      },
      "number": {
        "between": "Entre",
        "empty": "Vazio",
        "equals": "Igual",
        "gt": "Maior que",
        "gte": "Maior ou igual a",
        "lt": "Menor que",
        "lte": "Menor ou igual a",
        "not": "Diferente",
        "notBetween": "Não está entre",
        "notEmpty": "Não está vazio"
      },
      "string": {
        "contains": "Contém",
        "empty": "Vazio",
        "endsWith": "Termina em",
        "equals": "Igual",
        "not": "Diferente",
        "notEmpty": "Não está vazio",
        "startsWith": "Começa em"
      },
      "array": {
        "equals": "Igual",
        "empty": "Vazio",
        "contains": "Contém",
        "not": "Diferente",
        "notEmpty": "Não está vazio",
        "without": "Não contém"
      }
    },
    "data": "Dados",
    "deleteTitle": "Excluir condição de filtragem",
    "logicAnd": "E",
    "logicOr": "Ou",
    "title": {
      "0": "Construtor de pesquisa",
      "_": "Construtor de pesquisa (%d)"
    },
    "value": "Valor"
  },
  "searchPanes": {
    "clearMessage": "Limpar tudo",
    "collapse": {
      "0": "Painéis de pesquisa",
      "_": "Painéis de pesquisa (%d)"
    },
    "count": "{total}",
    "countFiltered": "{shown} ({total})",
    "emptyPanes": "Sem painéis de pesquisa",
    "loadMessage": "A carregar painéis de pesquisa",
    "title": "Filtros ativos"
  },
  "select": {
    "1": "%d linha seleccionada",
    "_": "%d linhas seleccionadas",
    "cells": {
      "1": "1 célula seleccionada",
      "_": "%d células seleccionadas"
    },
    "columns": {
      "1": "1 coluna seleccionada",
      "_": "%d colunas seleccionadas"
    }
  },
  "thousands": ".",
  "editor": {
    "close": "Fechar",
    "create": {
      "button": "Novo",
      "title": "Criar novo registro",
      "submit": "Criar"
    },
    "edit": {
      "button": "Editar",
      "title": "Editar registro",
      "submit": "Atualizar"
    },
    "remove": {
      "button": "Remover",
      "title": "Remover",
      "submit": "Remover"
    },
    "error": {
      "system": "Um erro no sistema ocorreu"
    },
    "multi": {
      "title": "Multiplos valores",
      "info": "Os itens selecionados contêm valores diferentes para esta entrada. Para editar e definir todos os itens para esta entrada com o mesmo valor, clique ou toque aqui, caso contrário, eles manterão seus valores individuais.",
      "restore": "Desfazer alterações"
    }
  },
  "info": "Mostrando os registos _START_ a _END_ num total de _TOTAL_",
  "infoEmpty": "Mostrando 0 os registos num total de 0"
};
module.exports = {
  portugues: portugues
};

/***/ }),

/***/ "./resources/js/Core/AppNavigation.js":
/*!********************************************!*\
  !*** ./resources/js/Core/AppNavigation.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  setOptionsMenu();
  setOptionsSubMenu();
});
var listMenu = $('.main-sidebar > .sidebar > .sidebar-menu > li');
var listMenuGroups = $('.main-sidebar > .sidebar > .sidebar-menu > li.treeview > .treeview-menu > li > a').addClass('targetSubMenu');

var setOptionsMenu = function setOptionsMenu() {
  listMenu.on('click', function (e) {
    e.preventDefault();

    if (!$(this).hasClass('treeview')) {
      var url = $(this).find('a').attr('href');
      setActive($(this));
      getNewScreen(url);
    }
  });
};

var setOptionsSubMenu = function setOptionsSubMenu() {
  listMenuGroups.on('click', function (e) {
    var url = $(this).attr('href');
    setActive($(this));
    getNewScreen(url);
  });
};

var setActive = function setActive(element) {
  if (element.hasClass('active')) {
    return;
  } //VERIFICA E REMOVE QUALQUER LI ATIVA


  var activeList = listMenu.find('.active');
  var subMenuActive = listMenuGroups.parent().find('.active');
  activeList.removeClass('active');
  subMenuActive.removeClass('active');
  element.parent().addClass("active");
};

var getNewScreen = function getNewScreen(url) {
  var elementWrapper = $('.content-wrapper');
  $.ajax({
    type: "GET",
    url: url,
    dataType: "HTML",
    beforeSend: function beforeSend() {
      AppUsage.loading(elementWrapper);
    },
    success: function success(response) {
      elementWrapper.html(response);
    },
    error: function error(err) {
      console.log(err);
    }
  });
};

module.exports = {
  setOptionsSubMenu: setOptionsSubMenu
};

/***/ }),

/***/ "./resources/js/Core/AppSettings.js":
/*!******************************************!*\
  !*** ./resources/js/Core/AppSettings.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  setupAjaxAllSuccess();
  adjustingDropDown();
});

var adjustingDropDown = function adjustingDropDown() {
  $('.table-responsive').on('shown.bs.dropdown', function (e) {
    var $table = $(this),
        $menu = $(e.target).find('.dropdown-menu'),
        tableOffsetHeight = $table.offset().top + $table.height(),
        menuOffsetHeight = $menu.offset().top + $menu.outerHeight(true);

    if (menuOffsetHeight > tableOffsetHeight) {
      $table.css("padding-bottom", menuOffsetHeight - tableOffsetHeight);
    }
  });
  $(".table-responsive").on("hide.bs.dropdown", function () {
    $(this).css('padding-bottom', 0);
  });
  $(".dropdown-menu > li > a").css('color', 'black');
};

var setupAjaxAllSuccess = function setupAjaxAllSuccess() {
  $(document).ajaxSuccess(function (event, xhr, settings) {
    if (!$.fn.DataTable.isDataTable($('.dataTable'))) {
      AppUsage.initializeDataTable();
    }
  });
};

module.exports = {
  setupAjaxAllSuccess: setupAjaxAllSuccess
};

/***/ }),

/***/ "./resources/js/Core/AppUsage.js":
/*!***************************************!*\
  !*** ./resources/js/Core/AppUsage.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  initializeDataTable();
  loadLibs();
});

var initializeDataTable = function initializeDataTable() {
  $(".dataTable").dataTable({
    buttons: ['pdf'],
    paging: false,
    searching: false,
    language: languageDataTable.portugues
  });
};

var loadLibs = function loadLibs() {
  $(".select2").select2({
    language: 'pt-BR',
    placeholder: 'Selecione uma opção',
    allowClear: true,
    width: '100%'
  });
};

var loadModal = function loadModal(url, modalObject) {
  var width = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : null;
  var callback = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : null;
  $(modalObject).modal({
    backdrop: 'static'
  }); //EVITA QUE O MODAL FECHE AO CLICAR FORA DO ESCOPO DO MODAL

  $(modalObject).find('.modal-dialog').css({
    width: !!width ? width : '800px'
  });
  $(modalObject).find('.modal-content').html("").append("<section>  \n            <div class=\"alert alert-primary\"> <i class=\"fa fa-spinner fa-spin\"> </i> Carregando... <div>\n        </section>");
  $(modalObject).find(".modal-content").load("".concat(url, " .modal-content >"), function () {
    //Executa novamente loadLibs para novo HTML 
    loadLibs();

    if (!!callback) {
      callback();
    }
  });
}; //PARAM - ELEMENTO A SER REMOVIDO PARA INSERÇÃO DO LOADING


var loading = function loading(element) {
  element.closest(element).html("\n        <div class=\"alert alert-danger\">\n            <div class=\"text-center\">    \n                <b> \n                    <i \n                        class=\"fa fa-circle-o-notch fa-spin\" aria-hidden=\"true\"\n                        style=\"font-size:30px;\"\n                    >  \n                    </i>   \n                </b>\n            </div>\n        </div>\n    ");
};

module.exports = {
  loadModal: loadModal,
  loadLibs: loadLibs,
  loading: loading,
  initializeDataTable: initializeDataTable
};

/***/ }),

/***/ "./resources/js/Logged/AppUsers.js":
/*!*****************************************!*\
  !*** ./resources/js/Logged/AppUsers.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  habilitaBotoes();
  habilitaEventos();
});
var modalObject = "#nivel1";

var habilitaEventos = function habilitaEventos() {
  $("#searchUser").on('submit', function (e) {
    e.preventDefault();
    var form = $(this).serialize();
    getUsersFilter(form);
  });
  $("#clear_filter_user").on('click', function () {
    var selects = $("#role, #setor");
    selects.select2('destroy').val("").select2();
  });
};

var habilitaBotoes = function habilitaBotoes() {
  $("#cadastrarUser").on("click", function () {
    var url = '/users/create';
    AppUsage.loadModal(url, modalObject, '800px', function () {});
  });
};

var getUsersFilter = function getUsersFilter(searchformData) {
  var gridUser = "#gridUsers";
  $.ajax({
    type: "GET",
    url: "/users/",
    data: searchformData,
    dataType: "HTML",
    beforeSend: function beforeSend() {
      AppUsage.loading($(gridUser));
    },
    success: function success(response) {
      $(gridUser).html($(response).find("".concat(gridUser, " >")));
      habilitaBotoes();
    }
  });
};

module.exports = {
  habilitaEventos: habilitaEventos,
  habilitaBotoes: habilitaBotoes
};

/***/ }),

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

//CORE Scripts - scripts de estrutura
window.AppNavigation = __webpack_require__(/*! ./Core/AppNavigation */ "./resources/js/Core/AppNavigation.js");
window.AppUsage = __webpack_require__(/*! ./Core/AppUsage */ "./resources/js/Core/AppUsage.js");
window.AppSettings = __webpack_require__(/*! ./Core/AppSettings */ "./resources/js/Core/AppSettings.js"); //AUTH Scripts - scripts em telas de authenticação/recuperação de senha

window.AppLogin = __webpack_require__(/*! ./Auth/AppLogin */ "./resources/js/Auth/AppLogin.js"); //LOGGED Scripts - scripts em módulos do sistema

window.AppUsers = __webpack_require__(/*! ./Logged/AppUsers */ "./resources/js/Logged/AppUsers.js"); //CONSTANTS Scripts - scripts re-utilizaveis

window.languageDataTable = __webpack_require__(/*! ./Constants/language_dataTable */ "./resources/js/Constants/language_dataTable.js");

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/app.scss ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\laragon\www\bt_source\resources\js\app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! C:\laragon\www\bt_source\resources\sass\app.scss */"./resources/sass/app.scss");


/***/ })

/******/ });