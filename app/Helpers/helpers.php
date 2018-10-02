<?php

use App\Acudiente;
use Facades\App\Facades\Jornada;
use Jenssegers\Date\Date;

/**
 * Devuelve el modelo administrativo asociado al usuario autenticado.
 *
 * @param string  $campo
 * @return \App\Administrativo  $administrativo
 */
function administrativo($campo = null)
{
    $usuario = auth()->user()->loadMissing('administrativo');

    return is_null($campo) ? optional($usuario->administrativo) : optional($usuario->administrativo)->{$campo};
}

/**
 * Devuelve el modelo docente asociado al usuario autenticado.
 *
 * @param string  $campo
 * @return \App\Docente  $docente
 */
function docente($campo = null)
{
    $usuario = auth()->user()->loadMissing('docente');

    return is_null($campo) ? optional($usuario->docente) : optional($usuario->docente)->{$campo};
}

/**
 * Devuelve el nombre del acudiente.
 *
 * @param string  $id
 * @return \App\Docente  $docente
 */
function acudienteSelect2($id)
{
    $acudiente = Acudiente::find($id);

    return optional($acudiente)->tipo_docu . ' ' . optional($acudiente)->docu_acud . ' &middot; ' . optional($acudiente)->nomb_acud . ' ' . optional($acudiente)->pape_acud . ' ' . optional($acudiente)->sape_acud;
}

/**
 * Traer todas las jornadas si es administrador y su jornada es todas, de resto la jornada actual
 *
 * @param string  $campo
 * @return array
 */
function jornada($campo = null)
{
	if (auth()->user()->esAdministrativo())
    {
        $administrativo = administrativo();

        if ($administrativo->jorn_admi === Jornada::todas())
        {
            $jornadasAdmin = ($campo === 'indexados') ? Jornada::adminIndexados() : Jornada::adminAsociativos();
        }
        else
        {
        	$indexados = [ $administrativo->jorn_admi ];

            $asociativos = [
                ['id' => $administrativo->jorn_admi, 'texto' => $administrativo->getJornada()],
            ];

            $jornadaAutenticado = ($campo === 'indexados') ? $indexados : $asociativos;
        }
    }

    $default = ($campo === 'indexados') ? Jornada::indexados() : Jornada::asociativos();

    return $jornadasAdmin ?? $jornadaAutenticado ?? $default;
}

/**
 * Formatea la fecha de inicio de fechas para la vista show
 *
 * @return \Date
 */
function datetime_inic_show($value)
{
    return isset($value['fech_inic']) ? Date::parse($value['fech_inic'])->format('d F Y \· h:i a') : '';
}

/**
 * Formatea la fecha final de fechas para la vista show
 *
 * @return \Date
 */
function datetime_fina_show($value)
{
    return isset($value['fech_fina']) ? Date::parse($value['fech_fina'])->format('d F Y \· h:i a') : '';
}

/**
 * Formatea la fecha de inicio de fechas para la vista edit
 *
 * @return \Date
 */
function datetime_inic_edit($value)
{
    return isset($value['fech_inic']) ? Date::parse($value['fech_inic'])->format('Y-m-d h:i a') : '';
}

/**
 * Formatea la fecha final de fechas para la vista edit
 *
 * @return \Date
 */
function datetime_fina_edit($value)
{
    return isset($value['fech_fina']) ? Date::parse($value['fech_fina'])->format('Y-m-d h:i a') : '';
}