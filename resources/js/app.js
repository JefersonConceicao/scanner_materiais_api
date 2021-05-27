//LIBS - scripts bibliotecas
import Dropzone from 'dropzone'
Dropzone.autoDiscover = false;
window.Swal = require('sweetalert2');
window.moment = require('moment');

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
window.AppTiposInfraestruturas = require('./Logged/AppTiposInfraestruturas');
window.AppLocalidades = require('./Logged/AppLocalidades');
window.AppLocalidadesDistancia = require('./Logged/AppLocalidadesDistancia');
window.AppLocalidadesInfraestrutura = require('./Logged/AppLocalidadesInfraestrutura');
window.AppLocalidadesEventoFesta = require('./Logged/AppLocalidadesEventoFesta');

//CONSTANTS métodos e propriedades constantes
window.languageDataTable = require('./Constants/language_dataTable');
window.AcessControl = require('./Constants/access_control');
      