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
  $.ajaxSetup({
    success: function success() {
      adjustingDropDown();
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
  loadLibs();
});

var loadLibs = function loadLibs() {
  //FUNÇÃO QUE HABILITA EVENTOS DE BIBLIOTECAS
  //SELECT2 
  $(".select2").select2({
    language: 'pt-BR',
    placeholder: 'Selecione uma opção',
    allowClear: true,
    width: '100%'
  });
};

var loadModal = function loadModal(url) {
  var callback = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
  var modal = "#myModal";
  $(modal).modal();
  $(modal).find('.modal-content').html("");
  $(modal).find('.modal-content').append("<section>  \n             <div class=\"alert alert-primary\"> Carregando... <div>\n         </section>");
  $(".modal-content").load("".concat(url, " .modal-content >"), function () {
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
  loading: loading
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
    AppUsage.loadModal(url, function () {});
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

window.AppLogin = __webpack_require__(/*! ./Auth/AppLogin */ "./resources/js/Auth/AppLogin.js");
window.AppUsers = __webpack_require__(/*! ./Logged/AppUsers */ "./resources/js/Logged/AppUsers.js");
window.AppSettings = __webpack_require__(/*! ./Core/AppSettings */ "./resources/js/Core/AppSettings.js");
window.AppUsage = __webpack_require__(/*! ./Core/AppUsage */ "./resources/js/Core/AppUsage.js");

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

__webpack_require__(/*! C:\laragon\www\novo_union\resources\js\app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! C:\laragon\www\novo_union\resources\sass\app.scss */"./resources/sass/app.scss");


/***/ })

/******/ });