/*
 * Métodos jQuery Inventario
 */
$(document).ready(function ()
{
    /**
	 * Guardar utiles
	 */
	$("#storeUtiles").submit(function (event)
	{
		event.preventDefault();


		$('select[name="implemento_id"]').removeClass("is-invalid");
		$('#error_implemento_id').removeClass("invalid-feedback").empty();

		$('input[name="cant_util"]').removeClass("is-invalid");
		$('#error_cant_util').removeClass("invalid-feedback").empty();

		$.ajax({
			url: '/inventarios',
			type: 'POST',
			headers: { 'X-CSRF-TOKEN': $("[name='_token']").val() },
			data: $('#storeUtiles').serialize(),
			cache: false,
			beforeSend: function ()
			{
				$(".loading").show();
			},
			success: function (data)
			{
				swal({
					title: data.message,
					type: 'success',
					toast: true,
					showConfirmButton: false,
					timer: 3000,
					position: 'top-right'
				});

				let html = `
					<tr>
						
						<td>
							${$('select[name="implemento_id"]').find(':selected').text()}
						</td>
						<td>
							${$('input[name="cant_util"]').val()}
						</td>
	            		<td>
	            			<button type="button" class="btn btn-sm btn-float btn-danger borrar" data-toggle="tooltip" title="Eliminar">
								<i class="material-icons">delete</i>
							</button>
						</tr>
					</tr>`;

	            $('#indexUtiles').append(html);
	            $('#storeUtiles').trigger('reset');
			},
			error: function (data)
			{
				if (typeof(data.responseJSON.errors) != 'undefined')
				{
					if (typeof(data.responseJSON.errors.estudiante_id) != 'undefined')
			        {
			        	swal({
							title: data.responseJSON.errors.estudiante_id[0],
							type: 'error',
							toast: true,
							showConfirmButton: false,
							timer: 3000,
							position: 'top-right'
						});
			        }
			        if (typeof(data.responseJSON.errors.implemento_id) != 'undefined')
			        {
						$('select[name="implemento_id"]').addClass("is-invalid");
						$('#error_implemento_id').addClass("invalid-feedback").empty().html(data.responseJSON.errors.implemento_id[0]);
			        }
			        if (typeof(data.responseJSON.errors.cant_util) != 'undefined')
			        {
						$('input[name="cant_util"]').addClass("is-invalid");
						$('#error_cant_util').addClass("invalid-feedback").empty().html(data.responseJSON.errors.cant_util[0]);
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
				$("#storeUtiles").find('button[type="submit"]').attr('disabled', false);
			}
		});
	});

    $(document).on('click', '.borrar', function (event)
    {
        event.preventDefault();
        $(this).closest('tr').remove();
    });

});