@extends('layouts.app')
@section('title', 'Actualizar fecha')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('fechas.index') }}">Fechas</a></li>
    <li class="breadcrumb-item"><a href="{{ route('fechas.edit', $fecha->id) }}">Editar</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">date_range</i> Actualizar fecha
		</h1>
	</div>
	<div class="card-body">

		<form method="post" action="{{ route('fechas.update', $fecha->id) }}" autocomplete="off">
			{{ csrf_field() }}
			{{ method_field('PUT') }}

			<div class="form-row">
                <div class="form-group col-md-4 d-flex align-items-end">
                    <p class="typography-subheading">Año de las fechas</p>
                </div>
				<div class="form-group col-md-8">
			    	<label>Año actual</label>
			    	<input type="number" name="ano_fech" class="form-control {{ $errors->has('ano_fech') ? 'is-invalid' : '' }}" value="{{ $fecha->ano_fech }}" required readonly>
	                @if ($errors->has('ano_fech'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('ano_fech') }}
	                    </div>
	               	@endif
			  	</div>
			</div>

			<blockquote class="blockquote my-3">
			  <p class="mb-0 typography-subheading">Registro notas regulares</p>
			  <hr class="w-100">
			</blockquote>

			<div class="form-row">
                <div class="form-group col-md-4 d-flex align-items-end">
                    <p class="typography-subheading">Fechas del primer periodo</p>
                </div>
				<div class="form-group col-md-4">
			    	<label>Desde</label>
			    	<input type="text" name="fech_not1_inic" class="start-datetimepicker form-control {{ $errors->has('fech_not1_inic') ? 'is-invalid' : '' }}" value="{{ old('fech_not1_inic', datetime_inic_edit($fecha->fech_not1)) }}" required>
	                @if ($errors->has('fech_not1_inic'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('fech_not1_inic') }}
	                    </div>
	               	@endif
			  	</div>
				<div class="form-group col-md-4">
			    	<label>Hasta</label>
			    	<input type="text" name="fech_not1_fina" class="end-datetimepicker form-control {{ $errors->has('fech_not1_fina') ? 'is-invalid' : '' }}" value="{{ old('fech_not1_fina', datetime_fina_edit($fecha->fech_not1)) }}" required>
	                @if ($errors->has('fech_not1_fina'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('fech_not1_fina') }}
	                    </div>
	               	@endif
			  	</div>
			</div>

			<div class="form-row">
                <div class="form-group col-md-4 d-flex align-items-end">
                    <p class="typography-subheading">Fechas del segundo periodo</p>
                </div>
				<div class="form-group col-md-4">
			    	<label>Desde</label>
			    	<input type="text" name="fech_not2_inic" class="start-datetimepicker form-control {{ $errors->has('fech_not2_inic') ? 'is-invalid' : '' }}" value="{{ old('fech_not2_inic', datetime_inic_edit($fecha->fech_not2)) }}" required>
	                @if ($errors->has('fech_not2_inic'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('fech_not2_inic') }}
	                    </div>
	               	@endif
			  	</div>
				<div class="form-group col-md-4">
			    	<label>Hasta</label>
			    	<input type="text" name="fech_not2_fina" class="end-datetimepicker form-control {{ $errors->has('fech_not2_fina') ? 'is-invalid' : '' }}" value="{{ old('fech_not2_fina', datetime_fina_edit($fecha->fech_not2)) }}" required>
	                @if ($errors->has('fech_not2_fina'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('fech_not2_fina') }}
	                    </div>
	               	@endif
			  	</div>
			</div>

			<div class="form-row">
                <div class="form-group col-md-4 d-flex align-items-end">
                    <p class="typography-subheading">Fechas del tercer periodo</p>
                </div>
				<div class="form-group col-md-4">
			    	<label>Desde</label>
			    	<input type="text" name="fech_not3_inic" class="start-datetimepicker form-control {{ $errors->has('fech_not3_inic') ? 'is-invalid' : '' }}" value="{{ old('fech_not3_inic', datetime_inic_edit($fecha->fech_not3)) }}" required>
	                @if ($errors->has('fech_not3_inic'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('fech_not3_inic') }}
	                    </div>
	               	@endif
			  	</div>
				<div class="form-group col-md-4">
			    	<label>Hasta</label>
			    	<input type="text" name="fech_not3_fina" class="end-datetimepicker form-control {{ $errors->has('fech_not3_fina') ? 'is-invalid' : '' }}" value="{{ old('fech_not3_fina', datetime_fina_edit($fecha->fech_not3)) }}" required>
	                @if ($errors->has('fech_not3_fina'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('fech_not3_fina') }}
	                    </div>
	               	@endif
			  	</div>
			</div>

			<div class="form-row">
                <div class="form-group col-md-4 d-flex align-items-end">
                    <p class="typography-subheading">Fechas del cuarto periodo</p>
                </div>
				<div class="form-group col-md-4">
			    	<label>Desde</label>
			    	<input type="text" name="fech_not4_inic" class="start-datetimepicker form-control {{ $errors->has('fech_not4_inic') ? 'is-invalid' : '' }}" value="{{ old('fech_not4_inic', datetime_inic_edit($fecha->fech_not4)) }}" required>
	                @if ($errors->has('fech_not4_inic'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('fech_not4_inic') }}
	                    </div>
	               	@endif
			  	</div>
				<div class="form-group col-md-4">
			    	<label>Hasta</label>
			    	<input type="text" name="fech_not4_fina" class="end-datetimepicker form-control {{ $errors->has('fech_not4_fina') ? 'is-invalid' : '' }}" value="{{ old('fech_not4_fina', datetime_fina_edit($fecha->fech_not4)) }}" required>
	                @if ($errors->has('fech_not4_fina'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('fech_not4_fina') }}
	                    </div>
	               	@endif
			  	</div>
			</div>

			<blockquote class="blockquote my-3">
			  <p class="mb-0 typography-subheading">Registro notas de recuperación</p>
			  <hr class="w-100">
			</blockquote>

			<div class="form-row">
                <div class="form-group col-md-4 d-flex align-items-end">
                    <p class="typography-subheading">Fechas del primer periodo</p>
                </div>
				<div class="form-group col-md-4">
			    	<label>Desde</label>
			    	<input type="text" name="fech_rec1_inic" class="start-datetimepicker form-control {{ $errors->has('fech_rec1_inic') ? 'is-invalid' : '' }}" value="{{ old('fech_rec1_inic', datetime_inic_edit($fecha->fech_rec1)) }}" required>
	                @if ($errors->has('fech_rec1_inic'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('fech_rec1_inic') }}
	                    </div>
	               	@endif
			  	</div>
				<div class="form-group col-md-4">
			    	<label>Hasta</label>
			    	<input type="text" name="fech_rec1_fina" class="end-datetimepicker form-control {{ $errors->has('fech_rec1_fina') ? 'is-invalid' : '' }}" value="{{ old('fech_rec1_fina', datetime_fina_edit($fecha->fech_rec1)) }}" required>
	                @if ($errors->has('fech_rec1_fina'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('fech_rec1_fina') }}
	                    </div>
	               	@endif
			  	</div>
			</div>

			<div class="form-row">
                <div class="form-group col-md-4 d-flex align-items-end">
                    <p class="typography-subheading">Fechas del segundo periodo</p>
                </div>
				<div class="form-group col-md-4">
			    	<label>Desde</label>
			    	<input type="text" name="fech_rec2_inic" class="start-datetimepicker form-control {{ $errors->has('fech_rec2_inic') ? 'is-invalid' : '' }}" value="{{ old('fech_rec2_inic', datetime_inic_edit($fecha->fech_rec2)) }}" required>
	                @if ($errors->has('fech_rec2_inic'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('fech_rec2_inic') }}
	                    </div>
	               	@endif
			  	</div>
				<div class="form-group col-md-4">
			    	<label>Hasta</label>
			    	<input type="text" name="fech_rec2_fina" class="end-datetimepicker form-control {{ $errors->has('fech_rec2_fina') ? 'is-invalid' : '' }}" value="{{ old('fech_rec2_fina', datetime_fina_edit($fecha->fech_rec2)) }}" required>
	                @if ($errors->has('fech_rec2_fina'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('fech_rec2_fina') }}
	                    </div>
	               	@endif
			  	</div>
			</div>

			<div class="form-row">
                <div class="form-group col-md-4 d-flex align-items-end">
                    <p class="typography-subheading">Fechas del tercer periodo</p>
                </div>
				<div class="form-group col-md-4">
			    	<label>Desde</label>
			    	<input type="text" name="fech_rec3_inic" class="start-datetimepicker form-control {{ $errors->has('fech_rec3_inic') ? 'is-invalid' : '' }}" value="{{ old('fech_rec3_inic', datetime_inic_edit($fecha->fech_rec3)) }}" required>
	                @if ($errors->has('fech_rec3_inic'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('fech_rec3_inic') }}
	                    </div>
	               	@endif
			  	</div>
				<div class="form-group col-md-4">
			    	<label>Hasta</label>
			    	<input type="text" name="fech_rec3_fina" class="end-datetimepicker form-control {{ $errors->has('fech_rec3_fina') ? 'is-invalid' : '' }}" value="{{ old('fech_rec3_fina', datetime_fina_edit($fecha->fech_rec3)) }}" required>
	                @if ($errors->has('fech_rec3_fina'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('fech_rec3_fina') }}
	                    </div>
	               	@endif
			  	</div>
			</div>

			<div class="form-row">
                <div class="form-group col-md-4 d-flex align-items-end">
                    <p class="typography-subheading">Fechas del cuarto periodo</p>
                </div>
				<div class="form-group col-md-4">
			    	<label>Desde</label>
			    	<input type="text" name="fech_rec4_inic" class="start-datetimepicker form-control {{ $errors->has('fech_rec4_inic') ? 'is-invalid' : '' }}" value="{{ old('fech_rec4_inic', datetime_inic_edit($fecha->fech_rec4)) }}" required>
	                @if ($errors->has('fech_rec4_inic'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('fech_rec4_inic') }}
	                    </div>
	               	@endif
			  	</div>
				<div class="form-group col-md-4">
			    	<label>Hasta</label>
			    	<input type="text" name="fech_rec4_fina" class="end-datetimepicker form-control {{ $errors->has('fech_rec4_fina') ? 'is-invalid' : '' }}" value="{{ old('fech_rec4_fina', datetime_fina_edit($fecha->fech_rec4)) }}" required>
	                @if ($errors->has('fech_rec4_fina'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('fech_rec4_fina') }}
	                    </div>
	               	@endif
			  	</div>
			</div>

			<div class="form-row">
				<div class="form-group col-md-12 text-center">
		  			<hr class="w-100">
			  		<button type="reset" class="btn btn-secondary">Limpiar</button>
			  		<button type="submit" class="btn btn-primary">Actualizar</button>
			  	</div>
			</div>

		</form>

	</div>
</div>
@endsection