var _extends=Object.assign||function(e){for(var a=1;a<arguments.length;a++){var t=arguments[a];for(var r in t)Object.prototype.hasOwnProperty.call(t,r)&&(e[r]=t[r])}return e};$(document).ready(function(){var e={labelMonthNext:"Ir al siguiente mes",labelMonthPrev:"Ir al mes anterior",labelMonthSelect:"Seleccione un mes del menú",labelYearSelect:"Seleccione un año del menú",selectMonths:!0,selectYears:10,monthsFull:["enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre"],monthsShort:["ene","feb","mar","abr","may","jun","jul","ago","sep","oct","nov","dic"],weekdaysFull:["domingo","lunes","martes","miércoles","jueves","viernes","sábado"],weekdaysShort:["dom","lun","mar","mié","jue","vie","sáb"],today:"hoy",clear:"borrar",close:"cerrar",cancel:"cancelar",firstDay:1,format:"yyyy-mm-dd",formatSubmit:"yyyy-mm-dd"};$(".pickdate").pickdate(_extends({},e));var a={lang:"es",weekStart:1,cancelText:"CANCELAR",clearButton:!0,clearText:"LIMPIAR"};$(".datepicker").bootstrapMaterialDatePicker(_extends({format:"YYYY-MM-DD",time:!1},a)),$(".timepicker").bootstrapMaterialDatePicker(_extends({format:"hh:mm a",shortTime:!0,date:!1,time:!0,monthPicker:!1,year:!1},a)),$(".datetimepicker").bootstrapMaterialDatePicker(_extends({format:"YYYY-MM-DD hh:mm a",shortTime:!0},a)),$(".today-datepicker").bootstrapMaterialDatePicker(_extends({format:"YYYY-MM-DD",minDate:new Date,time:!1},a)).on("change",function(e,a){e.preventDefault(),void 0!==$(".end-datepicker")&&$(".end-datepicker").bootstrapMaterialDatePicker("setMinDate",a)}),$(".until-datepicker").bootstrapMaterialDatePicker(_extends({format:"YYYY-MM-DD",maxDate:new Date,time:!1},a)),$(".start-datepicker").bootstrapMaterialDatePicker(_extends({format:"YYYY-MM-DD",time:!1},a)).on("change",function(e,a){e.preventDefault(),$(".end-datepicker").bootstrapMaterialDatePicker("setMinDate",a)}),$(".end-datepicker").bootstrapMaterialDatePicker(_extends({format:"YYYY-MM-DD",time:!1},a)),$(".start-datetimepicker").bootstrapMaterialDatePicker(_extends({format:"YYYY-MM-DD hh:mm a",shortTime:!0},a)).on("change",function(e,a){e.preventDefault(),$(".end-datetimepicker").bootstrapMaterialDatePicker("setMinDate",a)}),$(".today-datetimepicker").bootstrapMaterialDatePicker(_extends({format:"YYYY-MM-DD hh:mm a",minDate:new Date,shortTime:!0},a)).on("change",function(e,a){e.preventDefault(),$(".end-datetimepicker").bootstrapMaterialDatePicker("setMinDate",a)}),$(".end-datetimepicker").bootstrapMaterialDatePicker(_extends({format:"YYYY-MM-DD hh:mm a",shortTime:!0},a));var t={language:{sProcessing:"Procesando...",sLengthMenu:"Mostrar _MENU_ registros",sZeroRecords:"No se encontraron resultados",sEmptyTable:"Ningún dato disponible en esta tabla",sInfo:"Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",sInfoEmpty:"Mostrando registros del 0 al 0 de un total de 0 registros",sInfoFiltered:"(filtrado de un total de _MAX_ registros)",sInfoPostFix:"",sSearch:"Buscar:",sUrl:"",sInfoThousands:",",sLoadingRecords:"Cargando...",oPaginate:{sFirst:"Primero",sLast:"Último",sNext:"Siguiente",sPrevious:"Anterior"},oAria:{sSortAscending:": Activar para ordenar la columna de manera ascendente",sSortDescending:": Activar para ordenar la columna de manera descendente"}}};$(".datatable").DataTable(_extends({},t)),$('input:radio[name="special"]').change(function(e){if(e.preventDefault(),$(this).is(":checked")){var a=$(this).val();$('input:checkbox[id^="customCheck"]').each(function(e){"all-access"===a?$(this).prop("disabled",!0):$(this).prop("disabled",!1)})}}),$(".delete-swal").click(function(e){e.preventDefault();var a=$(this);swal({title:"¿Está seguro de eliminar?",text:"¡No podrás revertir esto!",type:"warning",showCancelButton:!0,confirmButtonText:"Eliminar",cancelButtonText:"Cancelar",buttonsStyling:!1,confirmButtonClass:"btn btn-danger",cancelButtonClass:"btn"}).then(function(e){e.value&&a.parent().submit()})}),$(".file").change(function(e){e.preventDefault();var a=$(this),t=a[0].files;if(t.length>0){var r=0;for(i=0;i<t.length;i++)(r+=t[i].size)>2097152&&(swal({title:"¡El archivo seleccionado supera el tamaño máximo permitido de 2 megabytes!",type:"error",toast:!0,showConfirmButton:!1,timer:5e3,position:"top-right"}),a.replaceWith(a.val("").clone(!0)))}}),$(".select2").select2({language:"es",theme:"bootstrap4"}),$("#acudiente_id").select2({language:"es",theme:"bootstrap4",ajax:{url:document.head.querySelector('meta[name="url"]').content+"/acudientes/buscar",dataType:"json",delay:250,data:function(e){return{sear_acud:e.term,page:e.page}},processResults:function(e,a){return e.items.push({id:"",text:"--- Seleccione ---"}),a.page=a.page||1,{results:e.items,pagination:{more:30*a.page<e.total_count}}},cache:!1},escapeMarkup:function(e){return e},minimumInputLength:3}),$("#acudiente_id").change(function(e){e.preventDefault();var a=$.trim($("#acudiente_id").val());void 0===a||null===a||""===a?($("#tipo_docu").prop("disabled",!1),$("#docu_acud").prop("readonly",!1),$("#nomb_acud").prop("readonly",!1),$("#pape_acud").prop("readonly",!1),$("#sape_acud").prop("readonly",!1),$("#dire_acud").prop("readonly",!1),$("#tele_acud").prop("readonly",!1),$("#corr_acud").prop("readonly",!1),$("#prof_acud").prop("readonly",!1),$("#sexo_acud").prop("disabled",!1),$("#barr_acud").prop("readonly",!1),$(".selectpicker").selectpicker("refresh")):($("#tipo_docu").prop("disabled",!0),$("#docu_acud").prop("readonly",!0),$("#nomb_acud").prop("readonly",!0),$("#pape_acud").prop("readonly",!0),$("#sape_acud").prop("readonly",!0),$("#dire_acud").prop("readonly",!0),$("#tele_acud").prop("readonly",!0),$("#corr_acud").prop("readonly",!0),$("#prof_acud").prop("readonly",!0),$("#sexo_acud").prop("disabled",!0),$("#barr_acud").prop("readonly",!0),$("select#tipo_docu").prop("selectedIndex",0),$("select#sexo_acud").prop("selectedIndex",0),$(".selectpicker").selectpicker("refresh"),$("#docu_acud").val(""),$("#nomb_acud").val(""),$("#pape_acud").val(""),$("#sape_acud").val(""),$("#dire_acud").val(""),$("#tele_acud").val(""),$("#corr_acud").val(""),$("#prof_acud").val(""),$("#barr_acud").val(""))})});
