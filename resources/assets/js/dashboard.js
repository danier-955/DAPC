/*
 * Métodos jQuery
 */
$(document).ready(function()
{
	/**
	 * Opciones datepicker daemonite
	 */
	let pickdateOptions = {
	  	labelMonthNext   : 'Ir al siguiente mes',
	  	labelMonthPrev   : 'Ir al mes anterior',
	  	labelMonthSelect : 'Seleccione un mes del menú',
	  	labelYearSelect  : 'Seleccione un año del menú',
	  	selectMonths     : true,
	  	selectYears      : 10,
	  	monthsFull: [ 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre' ],
	    monthsShort: [ 'ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov', 'dic' ],
	    weekdaysFull: [ 'domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado' ],
	    weekdaysShort: [ 'dom', 'lun', 'mar', 'mié', 'jue', 'vie', 'sáb' ],
	    today: 'hoy',
	    clear: 'borrar',
	    close: 'cerrar',
		cancel : 'cancelar',
	    firstDay: 1,
	    format: 'yyyy-mm-dd',
	    formatSubmit: 'yyyy-mm-dd'
	};

	/**
	 * Datepicker daemonite
	 */
	$('.pickdate').pickdate({
		...pickdateOptions,
	});

    /**
     * Opciones datepicker bootstrapMaterialDatePicker
     */
    let bootstrapMaterialDatePickerOptions = {
        lang : 'es',
        weekStart : 1,
        cancelText : 'CANCELAR',
        clearButton: true,
        clearText : 'LIMPIAR',
    };

	/**
	 * Datepicker
	 */
	$('.datepicker').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD',
        time: false,
        ...bootstrapMaterialDatePickerOptions,
    });

	/**
	 * Timepicker
	 */
	$('.timepicker').bootstrapMaterialDatePicker({
        format: 'hh:mm a',
        shortTime: true,
        date: false,
        time: true,
        monthPicker: false,
        year: false,
        ...bootstrapMaterialDatePickerOptions,
    });

	/**
	 * Datetimepicker
	 */
    $('.datetimepicker').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD hh:mm a',
        shortTime: true,
        ...bootstrapMaterialDatePickerOptions,
    });

    /**
     * Datepicker desde el dia de hoy
     */
    $('.today-datepicker').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD',
        minDate : new Date(),
        time: false,
        ...bootstrapMaterialDatePickerOptions,
    }).on('change', function(e, date)
    {
        e.preventDefault();
        if (typeof($('.end-datepicker')) != 'undefined')
        {
            $('.end-datepicker').bootstrapMaterialDatePicker('setMinDate', date);
        }
    });

    /**
     * Datepicker hasta el dia de hoy
     */
    $('.until-datepicker').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD',
        maxDate : new Date(),
        time: false,
        ...bootstrapMaterialDatePickerOptions,
    });

    /**
     * Datepicker inicial desde cualquier dia
     */
    $('.start-datepicker').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD',
        time: false,
        ...bootstrapMaterialDatePickerOptions,
    }).on('change', function(e, date)
	{
       e.preventDefault();
	   $('.end-datepicker').bootstrapMaterialDatePicker('setMinDate', date);
	});

    /**
     * Datepicker final que comienza desde la fecha inicial
     */
    $('.end-datepicker').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD',
        time: false,
        ...bootstrapMaterialDatePickerOptions,
    });

    /**
     * Datetimepicker inicial desde cualquier dia
     */
    $('.start-datetimepicker').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD hh:mm a',
        shortTime: true,
        ...bootstrapMaterialDatePickerOptions,
    }).on('change', function(e, date)
    {
       e.preventDefault();
       $('.end-datetimepicker').bootstrapMaterialDatePicker('setMinDate', date);
    });

    /**
     * Datetimepicker desde el dia de hoy
     */
    $('.today-datetimepicker').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD hh:mm a',
        minDate : new Date(),
        shortTime: true,
        ...bootstrapMaterialDatePickerOptions,
    }).on('change', function(e, date)
    {
        e.preventDefault();
        $('.end-datetimepicker').bootstrapMaterialDatePicker('setMinDate', date);
    });

    /**
     * Datetimepicker final que comienza desde la fecha inicial
     */
    $('.end-datetimepicker').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD hh:mm a',
        shortTime: true,
        ...bootstrapMaterialDatePickerOptions,
    });

	/**
	 * Opciones datatables global
	 */
	let datatablesOptions = {
		language: {
		    "sProcessing":     "Procesando...",
		    "sLengthMenu":     "Mostrar _MENU_ registros",
		    "sZeroRecords":    "No se encontraron resultados",
		    "sEmptyTable":     "Ningún dato disponible en esta tabla",
		    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
		    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
		    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		    "sInfoPostFix":    "",
		    "sSearch":         "Buscar:",
		    "sUrl":            "",
		    "sInfoThousands":  ",",
		    "sLoadingRecords": "Cargando...",
		    "oPaginate": {
		        "sFirst":    "Primero",
		        "sLast":     "Último",
		        "sNext":     "Siguiente",
		        "sPrevious": "Anterior"
		    },
		    "oAria": {
		        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
		        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
		    }
		}
	};

	/**
	 * Datatables global
	 */
    $('.datatable').DataTable({
		...datatablesOptions,
	});

    /**
	 * Deshabilitar los permisos si el rol tiene acceso total permitido
	 */
	$("input:radio[name=special]").change(function(e)
    {
        e.preventDefault();

        if ($(this).is(':checked'))
        {
            let special = $(this).val();

            $('input:checkbox[id^="customCheck"]').each(function(e)
            {
                if (special === 'all-access')
                {
                   $(this).prop('disabled', true);
                }
                else
                {
                    $(this).prop('disabled', false);
                }
            });
        }
    });

	/**
	 * SweetAlert para eliminar un registro, si da clic en "Si" envia el formulario
	 */
    $('.delete-swal').click(function (e)
    {
        e.preventDefault();
        let button = $(this);

        swal({
        	title: '¿Está seguro de eliminar?',
          	text: "¡No podrás revertir esto!",
          	type: 'warning',
          	showCancelButton: true,
          	// confirmButtonColor: '#f44336',
          	// cancelButtonColor: '#bdbdbd',
          	confirmButtonText: 'Eliminar',
          	cancelButtonText: 'Cancelar',
          	buttonsStyling: false,
          	confirmButtonClass: 'btn btn-danger',
          	cancelButtonClass: 'btn',
        })
        .then((result) => {
          if (result.value) {
            button.parent().submit();
          }
        })
    });

    /**
     * Validar el tamaño máximo de los archivos a subir: 1MB
     */
    $('.file').change(function (e)
    {
    	e.preventDefault();

    	let input = $(this);
    	let file = input[0].files;

	    if (file.length > 0)
	    {
	    	let size = 0; // Bytes
	    	let max = 1024 * 1024 * 2; // MegaBytes

	        for (i = 0; i < file.length; i++)
	        {
	        	size += file[i].size;

	          	if (size > max)
	          	{
	          		swal({
						title: '¡El archivo seleccionado supera el tamaño máximo permitido de 2 megabytes!',
					  	type: 'error',
					  	toast: true,
					  	showConfirmButton: false,
					  	timer: 5000,
					  	position: 'top-right'
					})

	          		/*
	          		 * Vaciar el input file
 	          		 */
	            	input.replaceWith(input.val('').clone(true));
	          	}
	        }
	    }
	});

    /**
     * Select2 global
     */
    $('.select2').select2({
        language: "es",
        theme: "bootstrap4",
    });

    /**
     * Select2 para acudiente (en registrar estudiante)
     */
    $("#acudiente_id").select2({
        language: "es",
        theme: "bootstrap4",
        ajax: {
            url: `${document.head.querySelector('meta[name="url"]').content}/acudientes/buscar`,
            dataType: 'json',
            delay: 250,
            data: function (params)
            {
                return {
                    sear_acud: params.term,
                    page: params.page
                };
            },
            processResults: function (data, params)
            {
                data.items.push({id: '', text: '---  acudiente ---'});
                params.page = params.page || 1;
                return {
                    results: data.items,
                    pagination: {
                      more: (params.page * 30) < data.total_count
                    }
                };
            },
            cache: false,
        },
        escapeMarkup: function (markup) { return markup; },
        minimumInputLength: 3,
    });
    readonlyAcudiente();
    $("#acudiente_id").change(function(e)
    {
        e.preventDefault();
        readonlyAcudiente();
    });

    function readonlyAcudiente()
    {
        var acudiente_id = $.trim($("#acudiente_id").val());
        if (acudiente_id == null || acudiente_id == "")
        {
            $("#tipo_docu").prop("disabled", false);
            $("#docu_acud").prop("readonly", false);
            $("#nomb_acud").prop("readonly", false);
            $("#pape_acud").prop("readonly", false);
            $("#dire_acud").prop("readonly", false);
            $("#tele_acud").prop("readonly", false);
            $("#emai_acud").prop("readonly", false);
            $("#pare_acud").prop("disabled", false);
        }
        else
        {
            $("#tipo_docu").prop("disabled", true);
            $("#docu_acud").prop("readonly", true);
            $("#nomb_acud").prop("readonly", true);
            $("#pape_acud").prop("readonly", true);
            $("#sape_acud").prop("readonly", true);
            $("#dire_acud").prop("readonly", true);
            $("#tele_acud").prop("readonly", true);
            $("#corr_acud").prop("readonly", true);
            $("#pare_acud").prop("disabled", true);
            $("#prof_acud").prop("disabled", true);
            $("#sexo_acud").prop("disabled", true);
            $("#barr_acud").prop("disabled", true);
            $("select#tipo_docu").prop('selectedIndex', 0);
            $("select#pare_acud").prop('selectedIndex', 0);
            $("select#sexo_acud").prop('selectedIndex', 0);
            $("#docu_acud").val("");
            $("#nomb_acud").val("");
            $("#pape_acud").val("");
            $("#dire_acud").val("");
            $("#tele_acud").val("");
            $("#corr_acud").val("");
        }
        return false;
    }

});