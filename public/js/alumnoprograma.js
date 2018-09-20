$(document).ready(function () {
	/**
 * Guardar utiles
 */
	$("#storeProgramas").submit(function (event) {
		event.preventDefault();

		$('select[name="alumno_id"]').removeClass("is-invalid");
		$('#error_alumno_id').removeClass("invalid-feedback").empty();

		$('select[name="programa_id"]').removeClass("is-invalid");
		$('#error_programa_id').removeClass("invalid-feedback").empty();

		$.ajax({
			url: '/alumnosprogramas',
			type: 'POST',
			headers: { 'X-CSRF-TOKEN': $("[name='_token']").val() },
			data: $('#storeProgramas').serialize(),
			cache: false,
			beforeSend: function beforeSend() {
				$(".loading").show();
			},
			success: function success(data) {
				swal({
					title: data.message,
					type: 'success',
					toast: true,
					showConfirmButton: false,
					timer: 3000,
					position: 'top-right'
				});

				var html = "\n\t\t\t\t\t<tr>\n\t\t\t\t\t\t<td>\n\t\t\t\t\t\t\t" + $('select[name="alumno_id"]').find(':selected').text() + "\n\t\t\t\t\t\t</td>\n\t\t\t\t\t\t<td>\n\t\t\t\t\t\t\t" + $('select[name="programa_id"]').find(':selected').text() + "\n\t\t\t\t\t\t</td>\n\t\t\t\t\t\n\t            \t\t<td>\n\t            \t\t\t<button type=\"button\" class=\"btn btn-sm btn-float btn-danger borrar\" data-toggle=\"tooltip\" title=\"Eliminar\">\n\t\t\t\t\t\t\t\t<i class=\"material-icons\">delete</i>\n\t\t\t\t\t\t\t</button>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t</tr>";

				$('#indexProgramas').append(html);
				$('#storeProgramas').trigger('reset');
			},
			error: function error(data) {
				if (typeof data.responseJSON.errors != 'undefined') {
					if (typeof data.responseJSON.errors.alumno_id != 'undefined') {
						$('select[name="alumno_id"]').addClass("is-invalid");
						$('#error_alumno_id').addClass("invalid-feedback").empty().html(data.responseJSON.errors.alumno_id[0]);
					}
					if (typeof data.responseJSON.errors.programa_id != 'undefined') {
						$('select[name="programa_id"]').addClass("is-invalid");
						$('#error_programa_id').addClass("invalid-feedback").empty().html(data.responseJSON.errors.programa_id[0]);
					}
				} else {
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
			complete: function complete() {
				$(".loading").hide();
				$("#storeProgramas").find('button[type="submit"]').attr('disabled', false);
			}
		});
	});

	$(document).on('click', '.borrar', function (event) {
		event.preventDefault();
		$(this).closest('tr').remove();
	});
});
