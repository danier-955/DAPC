<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class TipoEmpleado extends Model
{
    use Uuids;

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
        'nomb_tipo', 'desc_tipo',
    ];

    /*
    |----------------------------------------------------------------------
    | Relaciones
    |----------------------------------------------------------------------
    |
    */

    /**
     * Tipo de empleados tienen muchos empleados.
     *
     * @return Model
     */
    public function empleados()
    {
        return $this->hasMany(Empleado::class);
    }

    /**
     * Tipo de empleados tienen muchos pagos.
     *
     * @return Model
     */
    public function pagos()
    {
        return $this->belongsToMany(Pago::class);
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
