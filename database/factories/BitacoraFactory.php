<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(App\Bitacora::class, function (Faker $faker)
{
	/**
	 * Operaciones
	 */
	$operaciones = [
		Operacion::registrado(), Operacion::actualizado(), Operacion::eliminado()
	];

	/**
	 * Tablas
	 */
	$tablas = [
		'Acudientes', 'Administrativos', 'Alumnos', 'Areas', 'Asignaturas', 'Asistencias',
		'Calendarios', 'Docentes', 'Empleados', 'Estudiantes', 'Eventos', 'Fechas',
		'Galerias', 'Grados', 'Implementos', 'Inventarios', 'Mesas', 'Nominas',
		'Notas', 'Pagos', 'Permissions', 'Planeamientos', 'Practicantes', 'Roles', 'Salidas',
		'SubGrados', 'TipoEmpleados', 'Usuarios',
    ];

    return [
        'oper_bita' => $faker->randomElement($operaciones),
        'tabl_bita' => $faker->randomElement($tablas),
        'user_id' 	=> User::all()->random()->id,
    ];
});
