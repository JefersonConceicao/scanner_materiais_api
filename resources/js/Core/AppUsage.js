const { default: Swal } = require("sweetalert2");

$(function(){
    initializeDataTable();
    loadLibs();
})

const initializeDataTable = function(){
    $(".dataTable").dataTable({
        buttons:[
            'pdf',
        ],
        paging:false,
        searching: false,
        language: languageDataTable.portugues,
    });  
}

const loadLibs = function(){
    configSelect2();
    configMultiSelect();
    configMasks();
    configDateTimePicker();
}

/**
 * 
 * @param {string} url get url http request
 * @param {element} modalObject string selector do modal ex: "#modal1"
 * @param {string} width pixels ou porcentagem
 * @param {callback} callback função a ser executada dentro do modal ( geralmente utilizado p/ gerenciar eventos no modal)
 */

const loadModal = function(url, modalObject, width = null, callback = null){
    $(modalObject).modal({ backdrop: 'static'}); //EVITA QUE O MODAL FECHE AO CLICAR FORA DO ESCOPO DO MODAL
    $(modalObject).find('.modal-dialog').css({
        width: !!width ? width : '800px'
    });

    $(modalObject).find('.modal-content').html("").append(
        `<section>  
            <div class="alert alert-primary"> <i class="fa fa-spinner fa-spin"> </i> Carregando... <div>
        </section>`
    );
           
    $(modalObject).find(`.modal-content`).load(`${url} ${modalObject} > .modal-dialog > .modal-content >`, function(){
        //Executa novamente loadLibs para novo HTML 
        loadLibs();

        if(!!callback){
            callback();
        }
    }) 
}

//PARAM - ATRIBUI OPACIDADE AO ELEMENTO ENQUANTO ESTÁ EM CARREGAMENTO
const loading = function(element){  
    element.find('>').css({
        opacity: '0.5',
    })
}

const configMultiSelect = function(){
    $(".multiselect").multiSelect({
        selectableHeader: `<input type="text" 
                            class="form-control" 
                            autocomplete="off" 
                            placeholder="Pesquise... (Selecionáveis) " 
                        />`,

        selectionHeader: `<input 
                            type="text"
                            class="form-control" 
                            autocomplete="off" 
                            placeholder="Pesquise... (Selecionados) " 
                        />`,

        afterInit:function(ms){
            var that = this,
            $selectableSearch = that.$selectableUl.prev(),
            $selectionSearch = that.$selectionUl.prev(),
            selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
            selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

            that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
            .on('keydown', function(e){
                if (e.which === 40){
                    that.$selectableUl.focus();
                    return false;
                }
            });

            that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
            .on('keydown', function(e){
                if (e.which == 40){
                    that.$selectionUl.focus();
                    return false;
                }
            });
        },

        afterSelect:function(e){
            this.qs1.cache();
            this.qs2.cache();     
        },

        afterDeselect:function(){
            this.qs1.cache();
            this.qs2.cache();
        },
    });
}

const configSelect2 = function(){
    $(".select2").select2({  
        language:'pt-BR',
        placeholder: 'Selecione uma opção',
        allowClear:true,
        width:'100%',
    });  
}

const configDateTimePicker = function(){
    $.datetimepicker.setLocale('pt-BR');
    $(".datetimepicker").datetimepicker({   
        closeOnDateSelect: true,
        format: 'd/m/Y H:i:s',
    });

    $(".datepicker").datetimepicker({
        closeOnDateSelect: true,
        format: 'd/m/Y',
        timepicker:false,
    })

    $(".date-month-year").datetimepicker({
        closeOnDateSelect: true,
        format: 'm/Y',
        timepicker: false,
    })
}

const configMasks = function(){
    $(".money").inputmask('decimal',{
        alias: 'numeric',
        groupSeparator: ',',
        autoGroup: true,
        digits: '2',
        allowMinus:false,
        radixPoint: ".",
        prefix: "R$ ",
        placeholder: '',
    })

    $(".phone").inputmask('(99) 9999[9]-9999');
    $(".month-year").inputmask('99/99');
    $(".date").inputmask({
        mask: '99/99/9999',
        keepStatic: true
    });

    $(".decimal-numeric").inputmask({
        mask: "decimal",
        greedy: false,
        groupSeparator: '.',
        autoGroup:true,
        placeholder: '0'
    })

    $(".cnpjcpf").inputmask({
        mask: ['999.999.999-99', '99.999.999/9999-99'],
        keepStatic: true,
    })

    $(".cpf").inputmask({
        mask: '999.999.999-99',
        keepStatic: true
    })

    $(".cnpj").inputmask({
        mask: '99.999.999/9999-99',
        keepStatic: true
    })

    $(".cep").inputmask({
        mask: '99999-999',
        keepStatic:true,
    })
}

const showMessagesValidator = function(form, errorsRequest){
    if(form.length == 0){
        return;
    }   

    $('.error_feedback').html("");
    let fields = Object.keys(errorsRequest);
                    
    for(i=0; i < fields.length; i++){
        let input = $(`${form} input[name="${fields[i]}"]`);
        let select = $(`${form} select[name="${fields[i]}"]`);
        let textArea = $(`${form} textarea[name="${fields[i]}"]`);
   
        if(!!input){
            errorsRequest[fields[i]].forEach(value => {
                input.parent().find('.error_feedback').html(
                    `<p style="color:red;"> ${value} </p>`
                );
            })
        }

        if(!!select){
            errorsRequest[fields[i]].forEach(value => {
                select.parent().find('.error_feedback').html(
                    `<p style="color:red;"> ${value} </p>`
                );
            }) 
        }   

        if(!!textArea){
            errorsRequest[fields[i]].forEach(value => {
                textArea.parent().find('.error_feedback').html(
                    `<p style="color:red;"> ${value} </p>`
                );
            }) 
        }
    }    
}

/** 
 * @param {string} url 
 * @param {callback} onSuccess 
 * @param {callback} onError 
 */

const deleteForGrid = function(url, onSuccess = null, onError = null){
    $.ajax({
        method: "DELETE",
        url, 
        beforeSend:function(){
            
        },
        success:function(response){
            Swal.fire({
                position: 'top-end',
                icon: !response.error ? 'success' : 'error',
                title: `<b style="color:#fff"> ${response.msg} </b>`,
                toast: true,    
                showConfirmButton: false,
                timer: 3500,
                background: '#337ab7',
                iconColor: !response.error ? '#ffff' : 'red',
            })     

            if(!!onSuccess && !response.error){
                onSuccess();
            }  
            
        },
        error:function(jqXHR, textStatus, errorThrown){
        let msg = "Não foi possível excluir o registro, tente novamente mais tarde ou abra um chamado."
        
            if(!!jqXHR.responseJSON){
                let code = jqXHR.responseJSON.code

                switch (code) {
                    case "23000":
                        msg = "Não foi possível excluir este registro, pois o mesmo está sendo utilizado";
                        break;
                
                    default:
                        msg = msg
                    break;
                }
            }

            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: `<b style="color:#fff"> ${msg} </b>`,
                toast: true,    
                showConfirmButton: false,
                timer: 3500,
                timerProgressBar: true,
                background: '#e91313', 
                iconColor: '#ffff', 
            })

            if(!!onError){
                onError();
            }
        },
    });
}

const deleteMultipleRowsHelper = function(grid, callback = null){
    let selecteds = [];

    $(grid + " .table tbody > tr").on("click", function(e){
        if(e.target.tagName == "BUTTON" || e.target.tagName == "I" || e.target.tagName == "A"){
            return
        }

        let key = $(this).attr("key");     
        
        if(!!key){
            let indiceInArray = $.inArray(key, selecteds);

            if(indiceInArray > -1){ //SE O INDICE EXISTE NO ARRAY ENTÃO A LINHA JA ESTÁ SELECIONADA
                $(this).removeClass("row-selected");
                selecteds.splice(indiceInArray , 1);
            }else{
                $(this).addClass("row-selected");
                selecteds.push(key);
            }
        }   
        
        if($(".deleteALL").length == 1){
            $(".deleteALL").remove();
        }

        if(!!selecteds.length){
            $(".table").parent().prepend(`
                <a 
                    class="deleteALL btn btn-danger  btn-xs pull-right"
                > 
                    <i class="fa fa-trash"> </i> Excluir (${selecteds.length}) 
                </a>
            `);

            if(!!callback){
                callback();
            }
        }else{
            $(".deleteALL").remove();
        }
    });
}

const deleteMultipleRowsGrid = function(url, ids, callback = null){
    Swal.fire({
        title: `Deseja realmente excluir os ${ids.length} registros?`,
        text: 'Esta ação é irreversivel!',
        icon: 'warning',
        showCancelButton: true,
        reverseButtons: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirmar',
        cancelButtonText: 'Cancelar',
    }).then((result) => {
        if(result.isConfirmed){
            $.ajax({
                type: "DELETE",
                url: url,
                data: { ids: Array.from(ids)},
                dataType: "JSON",
                success: function (response) {
                    Swal.fire({
                        position: 'top-end',
                        icon: !response.error ? 'success' : 'error',
                        title: `<b style="color:#fff"> ${response.msg} </b>`,
                        toast: true,
                        showConfirmButton: false,
                        timer: 3500,
                        background: '#337ab7',
                    });

                    if(!response.error && !!callback){
                        callback()
                    }

                },
                error:function(jqXHR, textstatus, error){
                    console.log(error);
                }
            });
        }       
    })
}

const updateSelectInputJSON = function(element, url){
    $.ajax({
        type: "GET",
        url,
        dataType: "JSON",
        beforeSend:function(){
            element.html(`<option> Carregando... </option>`)
        },
        success: function (response) {
            element.html("");

            const arrayValues = Object.entries(response);
            
            for (let i = 0; i < arrayValues.length; i++) {
                element.append(`<option value="${arrayValues[i][0]}"> ${arrayValues[i][1]} </option>`);
            }
        },
        complete:function(){}
    });
}

module.exports = {
    loadModal,
    configMasks,
    loadLibs,
    loading,
    initializeDataTable,
    showMessagesValidator,
    deleteForGrid,
    deleteMultipleRowsHelper,
    deleteMultipleRowsGrid,
    updateSelectInputJSON,
}