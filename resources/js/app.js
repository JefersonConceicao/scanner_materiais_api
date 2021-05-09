//CORE Scripts - scripts de estrutura
window.AppNavigation = require('./Core/AppNavigation');
window.AppUsage = require('./Core/AppUsage');
window.AppSettings = require('./Core/AppSettings');

//AUTH Scripts - scripts em telas de authenticação/recuperação de senha
window.AppLogin = require('./Auth/AppLogin');

//LOGGED Scripts - scripts em módulos do sistema
window.AppUsers = require('./Logged/AppUsers');
window.AppProfile = require('./Logged/AppProfile');
window.AppPermissoes = require('./Logged/AppPermissoes');
window.AppModulos = require('./Logged/AppModulos');
window.AppFuncionalidades = require('./Logged/AppFuncionalidades');
window.AppRoles = require('./Logged/AppRoles');

//CONSTANTS Scripts - scripts re-utilizaveis
window.languageDataTable = require('./Constants/language_dataTable');

//LIBS - scripts bibliotecas
window.Swal = require('sweetalert2');        