//CORE Scripts - scripts de estrutura
import Dropzone from 'dropzone';
Dropzone.autoDiscover = false;

//CORE Scripts - scripts com funções genericas para toda a aplicação
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
window.AppUF = require('./Logged/AppUF');
window.AppTerritoriosTuristicos = require('./Logged/AppTerritoriosTuristicos');
window.AppZonasTuristicas = require('./Logged/AppZonasTuristicas');
window.Paises = require('./Logged/AppPaises');
window.AppTiposEventosFestas = require('./Logged/AppTiposEventosFestas');


//CONSTANTS Scripts - scripts re-utilizaveis
window.languageDataTable = require('./Constants/language_dataTable');
window.AcessControl = require('./Constants/access_control');

//LIBS - scripts bibliotecas
window.Swal = require('sweetalert2');        