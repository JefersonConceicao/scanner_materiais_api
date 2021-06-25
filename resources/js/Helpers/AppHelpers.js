const dateFormatPTToBritanic = function(data){
    let dia = data.split('/')[0];
    let mes = data.split('/')[1];
    let ano = data.split('/')[2];

    return ano + '-' + ("0"+mes).slice(-2) + '-' + ("0"+dia).slice(-2);
}   

module.exports = {
    dateFormatPTToBritanic,
}