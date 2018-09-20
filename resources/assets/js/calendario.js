/*
 * Métodos jQuery fullcalendar
 */
$(document).ready(function ()
{
	/**
	 * Inicializar fullCalendar
	 */
	$("#calendar").fullCalendar({
		theme: 'bootstrap4',
		locale: 'es',
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay,listMonth'
		},
		buttonText: {
			today: 'Hoy',
		    month: 'Mes',
		    week: 'Semana',
		    day: 'Agenda',
		    list: 'Día'
		},
		allDayHtml: 'Todo<br/>el día',
		eventLimitText: 'más',
		noEventsMessage: 'No hay eventos para mostrar',
		buttonIcons: {
			prev: 'left-single-arrow',
			next: 'right-single-arrow',
		},
	    defaultDate: moment().format('YYYY-MM-DD'),
	    timezone: 'America/Bogota',
	    navLinks: true,
      	editable: true,
      	eventLimit: true,
		events: {
			url: '/calendarios/eventos',
			type: 'GET',
			error: function (data)
			{
				swal({
					title: data.responseJSON.message,
					type: 'error',
					toast: true,
					showConfirmButton: false,
					timer: 3000,
					position: 'top-right'
				});
			},
			color: '#ff9800',
		},
		loading: function (isLoading, view)
		{
			$(".cargando").toggle();
		},
		dayClick: function (date, jsEvent, view)
		{
		    if(date.format('YYYY-MM-DD') < moment().format('YYYY-MM-DD'))
		    {
		        swal({
					title: '¡No es válido registrar un calendario desde una fecha pasada!',
					type: 'error',
					toast: true,
					showConfirmButton: false,
					timer: 3000,
					position: 'top-right'
				});
		    }
		    else
		    {
		        $("[name='fech_inic']").val(date.format());
				$('[class^="end-datepicker"]').bootstrapMaterialDatePicker('setMinDate', date);
				$("#createCalendario").modal('show');
		    }
		},
		eventClick: function (calEvent, jsEvent, view)
		{
			let edit_fech_fina, edit_hora_fina;

			if (calEvent.end) {
				edit_fech_fina = calEvent.end.format('YYYY-MM-DD');
				edit_hora_fina = calEvent.end.format('hh:mm a');
			}
			else {
				edit_fech_fina = calEvent.start.format('YYYY-MM-DD');
				edit_hora_fina = calEvent.start.format('hh:mm a');
			}

			$("[name='id']").val(calEvent.idCalendario);
			$("[name='edit_titu_cale']").val(calEvent.title);
			$("[name='edit_fech_inic']").val(calEvent.start.format('YYYY-MM-DD'));
			$("[name='edit_hora_inic']").val(calEvent.start.format('hh:mm a'));
			$("[name='edit_fech_fina']").val(edit_fech_fina);
			$("[name='edit_hora_fina']").val(edit_hora_fina);
			$("[name='edit_desc_cale']").val(calEvent.desc_cale);
			$("[name='edit_fina_cale']").val(calEvent.fina_cale);
			$("[name='edit_administrativo_id']").val(calEvent.administrativo_id);
			$("[name='edit_administrativo_id']").selectpicker('refresh');
			$('[class^="end-datepicker"]').bootstrapMaterialDatePicker('setMinDate', calEvent.start);
			$("#editCalendario").modal('show');
		}
	});

	/**
	 * Guardar calendario
	 */
	$("#storeCalendario").submit(function (event)
	{
		event.preventDefault();

		let campos = ['titu_cale', 'fech_inic', 'hora_inic', 'fech_fina', 'hora_fina', 'administrativo_id', 'desc_cale', 'fina_cale'];

		for (var i = 0; i < campos.length; i++)
		{
			$(`[name="${campos[i]}"]`).removeClass("is-invalid");
			$(`#error_${campos[i]}`).removeClass("invalid-feedback").empty();
		}

		let json = {
			titu_cale: $("[name='titu_cale']").val(),
			fech_inic: `${$("[name='fech_inic']").val()} ${$("[name='hora_inic']").val()}`,
			fech_fina: `${$("[name='fech_fina']").val()} ${$("[name='hora_fina']").val()}`,
			desc_cale: $("[name='desc_cale']").val(),
			fina_cale: $("[name='fina_cale']").val(),
			administrativo_id: $("[name='administrativo_id']").val(),
		};

		$.ajax({
			url: 'calendarios',
			type: 'POST',
			headers: { 'X-CSRF-TOKEN': $("[name='_token']").val() },
			data: json,
			dataType: 'JSON',
			cache: false,
			beforeSend: function ()
			{
				$(".loading").show();
			},
			success: function (data)
			{
				$("#storeCalendario").trigger('refresh');
				$("[name='administrativo_id']").selectpicker('refresh');
				$("#createCalendario").modal('hide');
				$("#calendar").fullCalendar('refetchEvents');

				swal({
					title: data.message,
					type: 'success',
					toast: true,
					showConfirmButton: false,
					timer: 3000,
					position: 'top-right'
				});
			},
			error: function (data)
			{
				if (typeof(data.responseJSON.errors) != 'undefined')
				{
					if (typeof(data.responseJSON.errors.titu_cale) != 'undefined')
			        {
						$('input[name="titu_cale"]').addClass("is-invalid");
						$('#error_titu_cale').addClass("invalid-feedback").empty().html(data.responseJSON.errors.titu_cale[0]);
			        }
			        if (typeof(data.responseJSON.errors.fech_inic) != 'undefined')
			        {
						$('input[name="fech_inic"]').addClass("is-invalid");
						$('#error_fech_inic').addClass("invalid-feedback").empty().html(data.responseJSON.errors.fech_inic[0]);

			          	$('input[name="hora_inic"]').addClass("is-invalid");
						$('#error_hora_inic').addClass("invalid-feedback").empty().html(data.responseJSON.errors.fech_inic[0]);
			        }
			        if (typeof(data.responseJSON.errors.fech_fina) != 'undefined')
			        {
			        	$('input[name="fech_fina"]').addClass("is-invalid");
						$('#error_fech_fina').addClass("invalid-feedback").empty().html(data.responseJSON.errors.fech_fina[0]);

						$('input[name="hora_fina"]').addClass("is-invalid");
						$('#error_hora_fina').addClass("invalid-feedback").empty().html(data.responseJSON.errors.fech_fina[0]);
			        }
			        if (typeof(data.responseJSON.errors.desc_cale) != 'undefined')
			        {
			        	$('textarea[name="desc_cale"]').addClass("is-invalid");
						$('#error_desc_cale').addClass("invalid-feedback").empty().html(data.responseJSON.errors.desc_cale[0]);
			        }
			        if (typeof(data.responseJSON.errors.fina_cale) != 'undefined')
			        {
			        	$('textarea[name="fina_cale"]').addClass("is-invalid");
						$('#error_fina_cale').addClass("invalid-feedback").empty().html(data.responseJSON.errors.fina_cale[0]);
			        }
				}
				else
				{
					swal({
						title: data.responseJSON.message,
						type: 'error',
						toast: true,
						showConfirmButton: false,
						timer: 3000,
						position: 'top-right'
					});
				}
			},
			complete: function ()
			{
				$(".loading").hide();
				$("#storeCalendario").find('button[type="submit"]').attr('disabled', false);
			}
		});
	});

	/**
	 * Actualizar calendario
	 */
	$("#updateCalendario").submit(function (event)
	{
		event.preventDefault();
		event.stopPropagation();

		let campos = ['titu_cale', 'fech_inic', 'hora_inic', 'fech_fina', 'hora_fina', 'administrativo_id', 'desc_cale', 'fina_cale'];

		for (var i = 0; i < campos.length; i++)
		{
			$(`[name="edit_${campos[i]}"]`).removeClass("is-invalid");
			$(`#error_edit_${campos[i]}`).removeClass("invalid-feedback").empty();
		}

		let id = $("[name='id']").val().trim();
		let json = {
			titu_cale: $("[name='edit_titu_cale']").val(),
			fech_inic: `${$("[name='edit_fech_inic']").val()} ${$("[name='edit_hora_inic']").val()}`,
			fech_fina: `${$("[name='edit_fech_fina']").val()} ${$("[name='edit_hora_fina']").val()}`,
			desc_cale: $("[name='edit_desc_cale']").val(),
			fina_cale: $("[name='edit_fina_cale']").val(),
			administrativo_id: $("[name='edit_administrativo_id']").val()
		};

		$.ajax({
			url: '/calendarios/' + id,
			type: 'PUT',
			headers: { 'X-CSRF-TOKEN': $("[name='_token']").val() },
			data: json,
			dataType: 'JSON',
			cache: false,
			beforeSend: function ()
			{
				$(".loading").show();
			},
			success: function (data)
			{
				$("#editCalendario").modal('hide');
				$("#calendar").fullCalendar('refetchEvents');

				swal({
					title: data.message,
					type: 'success',
					toast: true,
					showConfirmButton: false,
					timer: 3000,
					position: 'top-right'
				});
			},
			error: function (data)
			{
				if (typeof(data.responseJSON.errors) != 'undefined')
				{
					if (typeof(data.responseJSON.errors.titu_cale) != 'undefined')
			        {
						$('input[name="edit_titu_cale"]').addClass("is-invalid");
						$('#error_edit_titu_cale').addClass("invalid-feedback").empty().html(data.responseJSON.errors.titu_cale[0]);
			        }
			        if (typeof(data.responseJSON.errors.fech_inic) != 'undefined')
			        {
						$('input[name="edit_fech_inic"]').addClass("is-invalid");
						$('#error_edit_fech_inic').addClass("invalid-feedback").empty().html(data.responseJSON.errors.fech_inic[0]);

			          	$('input[name="edit_hora_inic"]').addClass("is-invalid");
						$('#error_edit_hora_inic').addClass("invalid-feedback").empty().html(data.responseJSON.errors.fech_inic[0]);
			        }
			        if (typeof(data.responseJSON.errors.fech_fina) != 'undefined') {
			        	$('input[name="edit_fech_fina"]').addClass("is-invalid");
						$('#error_edit_fech_fina').addClass("invalid-feedback").empty().html(data.responseJSON.errors.fech_fina[0]);

						$('input[name="edit_hora_fina"]').addClass("is-invalid");
						$('#error_edit_hora_fina').addClass("invalid-feedback").empty().html(data.responseJSON.errors.fech_fina[0]);
			        }
			        if (typeof(data.responseJSON.errors.desc_cale) != 'undefined') {
			        	$('textarea[name="edit_desc_cale"]').addClass("is-invalid");
						$('#error_edit_desc_cale').addClass("invalid-feedback").empty().html(data.responseJSON.errors.desc_cale[0]);
			        }
			        if (typeof(data.responseJSON.errors.fina_cale) != 'undefined') {
			        	$('textarea[name="edit_fina_cale"]').addClass("is-invalid");
						$('#error_edit_fina_cale').addClass("invalid-feedback").empty().html(data.responseJSON.errors.fina_cale[0]);
			        }
				}
				else
				{
					swal({
						title: data.responseJSON.message,
						type: 'error',
						toast: true,
						showConfirmButton: false,
						timer: 3000,
						position: 'top-right'
					});
				}
			},
			complete: function ()
			{
				$(".loading").hide();
				$("#updateCalendario").find('button[type="submit"]').attr('disabled', false);
			}
		})
	});

	/**
	 * Elimninar calendario
	 */
	$(".delete").click(function (event)
	{
		event.preventDefault();

		let id = $("[name='id']").val().trim();

		swal({
			title: '¿Está seguro de eliminar?',
			text: "¡No podrás revertir esto!",
			type: 'warning',
			showCancelButton: true,
			cancelButtonText: 'Cancelar',
			confirmButtonText: 'Eliminar',
			buttonsStyling: false,
			confirmButtonClass: 'btn btn-danger',
			cancelButtonClass: 'btn'
		})
		.then((result) =>
		{
			if (result.value)
			{
				$(".loading").show();

				$.ajax({
					url: '/calendarios/' + id,
					type: 'DELETE',
					dataType: 'JSON',
					headers: { 'X-CSRF-TOKEN': $("[name='_token']").val() },
					cache: false,
				})
				.done(function (data)
				{
					$(".loading").hide();
					$("#editCalendario").modal('hide');
					$("#calendar").fullCalendar('refetchEvents');

					swal({
						title: data.message,
						type: 'success',
						toast: true,
						showConfirmButton: false,
						timer: 3000,
						position: 'top-right'
					});
				})
				.fail(function (data)
				{
					$(".loading").hide();

					swal({
						title: data.responseJSON.message,
						type: 'error',
						toast: true,
						showConfirmButton: false,
						timer: 3000,
						position: 'top-right'
					});
				});
			}
		});
	});

});