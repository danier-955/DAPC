@extends('layouts.app')
@section('title', 'Planeaciones')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('planeamientos.index') }}">Planeaciones</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header d-flex align-items-center justify-content-between bg-light-2">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">local_library</i> Planeaciones
		</h1>
		@can('planeamientos.create')
        	@include('partials.button_create', ['route' => route('planeamientos.create')])
		@endcan
	</div>
	<div class="card-body">

		<form method="GET" action="{{ route('planeamientos.index') }}" autocomplete="off">
			<div class="row clearfix">
            	<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group">
						<label>Titulo</label>
						<input type="text" name="titu_plan"
							class="form-control {{ $errors->has('titu_plan') ? 'is-invalid' : '' }}"
							value="{{ old('titu_plan', Request::get('titu_plan')) }}">
		                @if ($errors->has('titu_plan'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('titu_plan') }}
		                    </div>
		               	@endif
					</div>
				</div>
				<div class="col-sm-12 col-md-3 col-lg-3">
					<div class="form-group">
						<label>Fecha inicial</label>
						<input type="text"
							class="start-datepicker form-control {{ $errors->has('fech_inic') ? 'is-invalid' : '' }}" name="fech_inic"
							value="{{ old('fech_inic', Request::get('fech_inic')) }}">
		                @if ($errors->has('fech_inic'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('fech_inic') }}
		                    </div>
		               	@endif
					</div>
				</div>
            	<div class="col-sm-12 col-md-3 col-lg-3">
					<div class="form-group">
						<label>Fecha final</label>
						<input type="text"
							class="end-datepicker form-control {{ $errors->has('fech_fina') ? 'is-invalid' : '' }}" name="fech_fina"
							value="{{ old('fech_fina', Request::get('fech_fina')) }}">
		                @if ($errors->has('fech_fina'))
		                    <div class="invalid-feedback">
		                        {{ $errors->first('fech_fina') }}
		                    </div>
		               	@endif
					</div>
				</div>
				<div class="col-sm-12 col-md-2 col-lg-2">
					<div class="form-group my-4 text-center">
						<button type="submit" class="btn btn-secondary">Búscar</button>
					</div>
				</div>
        	</div>
        </form>
	  	<hr class="mt-0 w-100">

		@if ($planeamientos->isNotEmpty())
            <div class="table-responsive">
                <table cellspacing="0" cellpadding="0" class="table table-striped table-hover mb-0">
			        <thead>
			            <tr>
			            	<th>#</th>
			                <th>Titulo</th>
			                <th>Fecha</th>
			                <th>Docente</th>
			                <th>Documento</th>
			                <th class="text-nowrap text-center">Opción</th>
			            </tr>
			        </thead>
		        	<tbody>
		           		 @foreach($planeamientos as $planeamiento)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $planeamiento->titu_plan }}</td>
								<td>{{ optional($planeamiento->fech_plan)->format('d/m/Y') }} </td>
								<td>{{ $planeamiento->getDocente() }}</td>
								<td>
									@can('planeamientos.download')
										@include('partials.button_download', ['btnSm' => 'btn-sm', 'route' => route('planeamientos.download', $planeamiento->id)])
									@else
										··· Sin permisos ···
									@endcan
								</td>
								<td class="text-nowrap text-center">
									@can('planeamientos.show')
                                    	@include('partials.button_show', ['route' => route('planeamientos.show', $planeamiento->id)])
									@endcan
									@can('planeamientos.edit')
										@include('partials.button_edit', ['btnSm' => 'btn-sm', 'route' => route('planeamientos.edit', $planeamiento->id)])
									@endcan
									@can('planeamientos.destroy')
										@include('partials.button_destroy', ['btnSm' => 'btn-sm', 'route' => route('planeamientos.destroy', $planeamiento->id)])
									@endcan
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		@else
            @component('partials.alert_empty')
                No hay planeaciones registrados.
            @endcomponent
        @endif
    </div>
    @if ($planeamientos->hasPages())
        <hr class="my-0 w-100">
        <div class="card-actions align-items-center justify-content-center px-3">
            {{ $planeamientos->appends(request()->query())->links() }}
        </div>
    @endif
</div>
@endsection