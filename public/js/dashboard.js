var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

/*
 * Métodos jQuery
 */
$(document).ready(function () {
    /**
     * Opciones datepicker daemonite
     */
    var pickdateOptions = {
        labelMonthNext: 'Ir al siguiente mes',
        labelMonthPrev: 'Ir al mes anterior',
        labelMonthSelect: 'Seleccione un mes del menú',
        labelYearSelect: 'Seleccione un año del menú',
        selectMonths: true,
        selectYears: 10,
        monthsFull: ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'],
        monthsShort: ['ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov', 'dic'],
        weekdaysFull: ['domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'],
        weekdaysShort: ['dom', 'lun', 'mar', 'mié', 'jue', 'vie', 'sáb'],
        today: 'hoy',
        clear: 'borrar',
        close: 'cerrar',
        cancel: 'cancelar',
        firstDay: 1,
        format: 'yyyy-mm-dd',
        formatSubmit: 'yyyy-mm-dd'
    };

    /**
     * Datepicker daemonite
     */
    $('.pickdate').pickdate(_extends({}, pickdateOptions));

    /**
     * Opciones datepicker bootstrapMaterialDatePicker
     */
    var bootstrapMaterialDatePickerOptions = {
        lang: 'es',
        weekStart: 1,
        cancelText: 'CANCELAR',
        clearButton: true,
        clearText: 'LIMPIAR'
    };

    /**
     * Datepicker
     */
    $('.datepicker').bootstrapMaterialDatePicker(_extends({
        format: 'YYYY-MM-DD',
        time: false
    }, bootstrapMaterialDatePickerOptions));

    /**
     * Timepicker
     */
    $('.timepicker').bootstrapMaterialDatePicker(_extends({
        format: 'hh:mm a',
        shortTime: true,
        date: false,
        time: true,
        monthPicker: false,
        year: false
    }, bootstrapMaterialDatePickerOptions));

    /**
     * Datetimepicker
     */
    $('.datetimepicker').bootstrapMaterialDatePicker(_extends({
        format: 'YYYY-MM-DD hh:mm a',
        shortTime: true
    }, bootstrapMaterialDatePickerOptions));

    /**
     * Datepicker desde el dia de hoy
     */
    $('.today-datepicker').bootstrapMaterialDatePicker(_extends({
        format: 'YYYY-MM-DD',
        minDate: new Date(),
        time: false
    }, bootstrapMaterialDatePickerOptions)).on('change', function (e, date) {
        e.preventDefault();
        if (typeof $('.end-datepicker') != 'undefined') {
            $('.end-datepicker').bootstrapMaterialDatePicker('setMinDate', date);
        }
    });

    /**
     * Datepicker hasta el dia de hoy
     */
    $('.until-datepicker').bootstrapMaterialDatePicker(_extends({
        format: 'YYYY-MM-DD',
        maxDate: new Date(),
        time: false
    }, bootstrapMaterialDatePickerOptions));

    /**
     * Datepicker inicial desde cualquier dia
     */
    $('.start-datepicker').bootstrapMaterialDatePicker(_extends({
        format: 'YYYY-MM-DD',
        time: false
    }, bootstrapMaterialDatePickerOptions)).on('change', function (e, date) {
        e.preventDefault();
        $('.end-datepicker').bootstrapMaterialDatePicker('setMinDate', date);
    });

    /**
     * Datepicker final que comienza desde la fecha inicial
     */
    $('.end-datepicker').bootstrapMaterialDatePicker(_extends({
        format: 'YYYY-MM-DD',
        time: false
    }, bootstrapMaterialDatePickerOptions));

    /**
     * Datetimepicker inicial desde cualquier dia
     */
    $('.start-datetimepicker').bootstrapMaterialDatePicker(_extends({
        format: 'YYYY-MM-DD hh:mm a',
        shortTime: true
    }, bootstrapMaterialDatePickerOptions)).on('change', function (e, date) {
        e.preventDefault();
        $('.end-datetimepicker').bootstrapMaterialDatePicker('setMinDate', date);
    });

    /**
     * Datetimepicker desde el dia de hoy
     */
    $('.today-datetimepicker').bootstrapMaterialDatePicker(_extends({
        format: 'YYYY-MM-DD hh:mm a',
        minDate: new Date(),
        shortTime: true
    }, bootstrapMaterialDatePickerOptions)).on('change', function (e, date) {
        e.preventDefault();
        $('.end-datetimepicker').bootstrapMaterialDatePicker('setMinDate', date);
    });

    /**
     * Datetimepicker final que comienza desde la fecha inicial
     */
    $('.end-datetimepicker').bootstrapMaterialDatePicker(_extends({
        format: 'YYYY-MM-DD hh:mm a',
        shortTime: true
    }, bootstrapMaterialDatePickerOptions));

    /**
     * Opciones datatables global
     */
    var datatablesOptions = {
        language: {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    };

    /**
     * Datatables global
     */
    $('.datatable').DataTable(_extends({}, datatablesOptions));

    /**
    * Deshabilitar los permisos si el rol tiene acceso total permitido
    */
    $("input:radio[name=special]").change(function (e) {
        e.preventDefault();

        if ($(this).is(':checked')) {
            var special = $(this).val();

            $('input:checkbox[id^="customCheck"]').each(function (e) {
                if (special === 'all-access') {
                    $(this).prop('disabled', true);
                } else {
                    $(this).prop('disabled', false);
                }
            });
        }
    });

    /**
     * SweetAlert para eliminar un registro, si da clic en "Si" envia el formulario
     */
    $('.delete-swal').click(function (e) {
        e.preventDefault();
        var button = $(this);

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
            cancelButtonClass: 'btn'
        }).then(function (result) {
            if (result.value) {
                button.parent().submit();
            }
        });
    });

    /**
     * Validar el tamaño máximo de los archivos a subir: 1MB
     */
    $('.file').change(function (e) {
        e.preventDefault();

        var input = $(this);
        var file = input[0].files;

        if (file.length > 0) {
            var size = 0; // Bytes
            var max = 1024 * 1024 * 2; // MegaBytes

            for (i = 0; i < file.length; i++) {
                size += file[i].size;

                if (size > max) {
                    swal({
                        title: '¡El archivo seleccionado supera el tamaño máximo permitido de 2 megabytes!',
                        type: 'error',
                        toast: true,
                        showConfirmButton: false,
                        timer: 5000,
                        position: 'top-right'
                    });

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
        theme: "bootstrap4"
    });
});
