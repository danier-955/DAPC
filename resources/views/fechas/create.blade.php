@extends('layouts.app')
@section('title', 'Registrar fecha')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('fechas.index') }}">Fechas</a></li>
    <li class="breadcrumb-item"><a href="{{ route('fechas.create') }}">Registrar</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">date_range</i> Registrar fecha
		</h1>
	</div>
	<div class="card-body">

		<form method="post" action="{{ route('fechas.store') }}" autocomplete="off">
			{{ csrf_field() }}

			<div class="form-row">
                <div class="form-group col-md-4 d-flex align-items-end">
                    <p class="typography-subheading">Año de las fechas</p>
                </div>
				<div class="form-group col-md-8">
			    	<label>Año actual</label>
			    	<input type="number" name="ano_fech" class="form-control {{ $errors->has('ano_fech') ? 'is-invalid' : '' }}" value="{{ now()->year }}" required readonly>
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
			    	<input type="text" name="fech_not1_inic" class="start-datetimepicker form-control {{ $errors->has('fech_not1_inic') ? 'is-invalid' : '' }}" value="{{ old('fech_not1_inic') }}" required>
	                @if ($errors->has('fech_not1_inic'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('fech_not1_inic') }}
	                    </div>
	               	@endif
			  	</div>
				<div class="form-group col-md-4">
			    	<label>Hasta</label>
			    	<input type="text" name="fech_not1_fina" class="end-datetimepicker form-control {{ $errors->has('fech_not1_fina') ? 'is-invalid' : '' }}" value="{{ old('fech_not1_fina') }}" required>
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
			    	<input type="text" name="fech_not2_inic" class="start-datetimepicker form-control {{ $errors->has('fech_not2_inic') ? 'is-invalid' : '' }}" value="{{ old('fech_not2_inic') }}" required>
	                @if ($errors->has('fech_not2_inic'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('fech_not2_inic') }}
	                    </div>
	               	@endif
			  	</div>
				<div class="form-group col-md-4">
			    	<label>Hasta</label>
			    	<input type="text" name="fech_not2_fina" class="end-datetimepicker form-control {{ $errors->has('fech_not2_fina') ? 'is-invalid' : '' }}" value="{{ old('fech_not2_fina') }}" required>
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
			    	<input type="text" name="fech_not3_inic" class="start-datetimepicker form-control {{ $errors->has('fech_not3_inic') ? 'is-invalid' : '' }}" value="{{ old('fech_not3_inic') }}" required>
	                @if ($errors->has('fech_not3_inic'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('fech_not3_inic') }}
	                    </div>
	               	@endif
			  	</div>
				<div class="form-group col-md-4">
			    	<label>Hasta</label>
			    	<input type="text" name="fech_not3_fina" class="end-datetimepicker form-control {{ $errors->has('fech_not3_fina') ? 'is-invalid' : '' }}" value="{{ old('fech_not3_fina') }}" required>
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
			    	<input type="text" name="fech_not4_inic" class="start-datetimepicker form-control {{ $errors->has('fech_not4_inic') ? 'is-invalid' : '' }}" value="{{ old('fech_not4_inic') }}" required>
	                @if ($errors->has('fech_not4_inic'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('fech_not4_inic') }}
	                    </div>
	               	@endif
			  	</div>
				<div class="form-group col-md-4">
			    	<label>Hasta</label>
			    	<input type="text" name="fech_not4_fina" class="end-datetimepicker form-control {{ $errors->has('fech_not4_fina') ? 'is-invalid' : '' }}" value="{{ old('fech_not4_fina') }}" required>
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
			    	<input type="text" name="fech_rec1_inic" class="start-datetimepicker form-control {{ $errors->has('fech_rec1_inic') ? 'is-invalid' : '' }}" value="{{ old('fech_rec1_inic') }}" required>
	                @if ($errors->has('fech_rec1_inic'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('fech_rec1_inic') }}
	                    </div>
	               	@endif
			  	</div>
				<div class="form-group col-md-4">
			    	<label>Hasta</label>
			    	<input type="text" name="fech_rec1_fina" class="end-datetimepicker form-control {{ $errors->has('fech_rec1_fina') ? 'is-invalid' : '' }}" value="{{ old('fech_rec1_fina') }}" required>
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
			    	<input type="text" name="fech_rec2_inic" class="start-datetimepicker form-control {{ $errors->has('fech_rec2_inic') ? 'is-invalid' : '' }}" value="{{ old('fech_rec2_inic') }}" required>
	                @if ($errors->has('fech_rec2_inic'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('fech_rec2_inic') }}
	                    </div>
	               	@endif
			  	</div>
				<div class="form-group col-md-4">
			    	<label>Hasta</label>
			    	<input type="text" name="fech_rec2_fina" class="end-datetimepicker form-control {{ $errors->has('fech_rec2_fina') ? 'is-invalid' : '' }}" value="{{ old('fech_rec2_fina') }}" required>
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
			    	<input type="text" name="fech_rec3_inic" class="start-datetimepicker form-control {{ $errors->has('fech_rec3_inic') ? 'is-invalid' : '' }}" value="{{ old('fech_rec3_inic') }}" required>
	                @if ($errors->has('fech_rec3_inic'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('fech_rec3_inic') }}
	                    </div>
	               	@endif
			  	</div>
				<div class="form-group col-md-4">
			    	<label>Hasta</label>
			    	<input type="text" name="fech_rec3_fina" class="end-datetimepicker form-control {{ $errors->has('fech_rec3_fina') ? 'is-invalid' : '' }}" value="{{ old('fech_rec3_fina') }}" required>
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
			    	<input type="text" name="fech_rec4_inic" class="start-datetimepicker form-control {{ $errors->has('fech_rec4_inic') ? 'is-invalid' : '' }}" value="{{ old('fech_rec4_inic') }}" required>
	                @if ($errors->has('fech_rec4_inic'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('fech_rec4_inic') }}
	                    </div>
	               	@endif
			  	</div>
				<div class="form-group col-md-4">
			    	<label>Hasta</label>
			    	<input type="text" name="fech_rec4_fina" class="end-datetimepicker form-control {{ $errors->has('fech_rec4_fina') ? 'is-invalid' : '' }}" value="{{ old('fech_rec4_fina') }}" required>
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
			  		<button type="submit" class="btn btn-primary">Registrar</button>
			  	</div>
			</div>

		</form>

	</div>
</div>
@endsection