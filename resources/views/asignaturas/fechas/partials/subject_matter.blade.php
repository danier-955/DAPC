<blockquote class="blockquote my-3">
	<p class="mb-0 typography-subheading">Información de la asignatura</p>
  	<hr class="w-100">
</blockquote>

<div class="table-responsive">
	<table cellspacing="0" cellpadding="0" class="table table-striped mb-0">
		<tbody>
			<tr>
				<th>
					<span class="font-weight-bold">Asignatura</span>
				</th>
				<td>{{ $asignatura->nomb_asig }}</td>
				<th>
					<span class="font-weight-bold">Area</span>
				</th>
				<td>{{ $asignatura->getArea() }}</td>
			</tr>
			<tr>
				<th>
					<span class="font-weight-bold">Grado</span>
				</th>
				<td>{{ $asignatura->getGrado() }}</td>
				<th>
					<span class="font-weight-bold">Docente</span>
				</th>
				<td>{{ $asignatura->getDocente() }}</td>
			</tr>
		</tbody>
	</table>
</div>

<blockquote class="blockquote my-3">
  	<p class="mb-0 typography-subheading">{{ $slot }}</p>
  	<hr class="w-100">
</blockquote>