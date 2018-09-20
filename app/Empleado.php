<?php

namespace App;

use App\Traits\DatesTranslator;
use App\Traits\Uuids;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use Uuids, DatesTranslator;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fech_ingr', 'obse_empl', 'tipo_empleado_id',
    ];

    /**
     * The attributes dates.
     *
     * @var array
     */
    protected $dates = [
        'fech_ingr',
    ];

    /*
    |----------------------------------------------------------------------
    | Mutadores
    |----------------------------------------------------------------------
    |
    */

    /**
     * Convierte el string a fecha al momento de guardar.
     *
     * @var value
     * @return void
     */
    public function setFechIngrAttribute($value)
    {
        $this->attributes['fech_ingr'] = Carbon::parse($value);
    }

    /*
    |----------------------------------------------------------------------
    | Relaciones
    |----------------------------------------------------------------------
    |
    */

    /**
     * Empleado tiene un administrativo.
     *
     * @return Model
     */
    public function administrativo()
    {
        return $this->hasOne(Administrativo::class);
    }

    /**
     * Empleado tiene un docente.
     *
     * @return Model
     */
    public function docente()
    {
        return $this->hasOne(Docente::class);
    }

    /**
     * Empleado pertenece a un tipo de empleado.
     *
     * @return Model
     */
    public function tipoEmpleado()
    {
        return $this->belongsTo(TipoEmpleado::class);
    }

    /**
     * Empleados tienen muchas nominas.
     *
     * @return Model
     */
    public function nominas()
    {
        return $this->belongsToMany(Nomina::class);
    }

    /*
    |----------------------------------------------------------------------
    | Métodos
    |----------------------------------------------------------------------
    |
    */

    /*
    |----------------------------------------------------------------------
    | Scopes
    |----------------------------------------------------------------------
    |
    */
}
