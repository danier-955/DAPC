<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class SeguimientoScope implements Scope
{

	public function apply(Builder $builder, Model $model)
	{
		$builder->with(
			'docente:id,nomb_doce,pape_doce,sape_doce',
			'practicante:id,nomb_prac,pape_prac,sape_prac'
		);
	}
}