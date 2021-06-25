//LIBS - scripts bibliotecas
import Dropzone from 'dropzone'
Dropzone.autoDiscover = false;
window.Swal = require('sweetalert2');
window.moment = require('moment');

//HELPERS Scripts - scripts re-utilizaveis para auxílio no desenvolvimento
window.AppHelpers = require('./Helpers/AppHelpers');

//CORE Scripts - scripts com funções genericas para toda a aplicação
window.AppNavigation = require('./Core/AppNavigation');
window.AppUsage = require('./Core/AppUsage');
window.AppSettings = require('./Core/AppSettings');

//AUTH Scripts - scripts em telas de authenticação/recuperação de senha
window.AppLogin = require('./Auth/AppLogin');
window.AppForgotPassword = require('./Auth/AppForgotPassword');

//LOGGED Scripts - scripts em módulos do sistema
window.AppUsers = require('./Logged/AppUsers');
window.AppProfile = require('./Logged/AppProfile');
window.AppRoles = require('./Logged/AppRoles');

//CONSTANTS métodos e propriedades constantes
window.languageDataTable = require('./Constants/language_dataTable');
window.AcessControl = require('./Constants/access_control');
      