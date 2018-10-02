@extends('layouts.app')
@section('title', 'Calendarios')

@section('content')
<nav aria-label="breadcrumb">
	<ol class="breadcrumb bg-white shadow-1">
		<li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
		<li class="breadcrumb-item"><a href="{{ route('calendarios.index') }}">Calendarios</a></li>
		<li class="breadcrumb-item active" aria-current="page">Estas aquí</li>
	</ol>
</nav>

<div class="card">
	<div class="card-header d-flex align-items-center justify-content-between bg-light-2">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">event</i> Calendarios
		</h1>
		<div class="cargando" style="display: none;">
			<i class="fas fa-sync fa-spin fa-3x"></i>
		</div>
	</div>
	<div class="card-body">
		<ipca-calendar
			:administrativo-id="'{{ boolval(auth()->user()->esAdministrativo()) ? administrativo('id') : null }}'"
			:jornadas="{{ json_encode($jornadas) }}"
			:is-admin="{{ boolval(Shinobi::isRole(SpecialRole::administrador())) ? 'true' : 'false' }}"
			:can-create="{{ boolval(Shinobi::can('calendarios.create')) ? 'true' : 'false' }}"
			:can-edit="{{ boolval(Shinobi::can('calendarios.edit')) ? 'true' : 'false' }}"
			:can-destroy="{{ boolval(Shinobi::can('calendarios.destroy')) ? 'true' : 'false' }}">
		</ipca-calendar>
	</div>
</div>
@endsection