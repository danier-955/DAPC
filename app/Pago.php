<?php

namespace App;

use App\Traits\Uuids;
use Facades\App\Facades\TipoPago;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
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
        'conc_pago', 'tota_pago', 'tipo_pago',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'tipo_pago' => 'string',
    ];

    /*
    |----------------------------------------------------------------------
    | Relaciones
    |----------------------------------------------------------------------
    |
    */

    /**
     * Pagos tienen muchos tipos de empleados.
     *
     * @return Model
     */
    public function tipoEmpleados()
    {
        return $this->belongsToMany(TipoEmpleado::class);
    }

    /**
     * Pagos tienen muchas nominas.
     *
     * @return Model
     */
    public function nominas()
    {
        return $this->hasMany(Nomina::class);
    }

    /**
     * Pagos tienen muchas salidas.
     *
     * @return Model
     */
    public function salidas()
    {
        return $this->belongsToMany(Salida::class);
    }

    /**
     * Pagos tienen muchos eventos.
     *
     * @return Model
     */
    public function eventos()
    {
        return $this->belongsToMany(Evento::class);
    }

    /*
    |----------------------------------------------------------------------
    | Métodos
    |----------------------------------------------------------------------
    |
    */

    /**
     * Devuelve el nombre del tipo de pago
     *
     * @return string
     */
    public function getTipoPago()
    {
        return optional(TipoPago::find($this->tipo_pago))['texto'];
    }

    /*
    |----------------------------------------------------------------------
    | Scopes
    |----------------------------------------------------------------------
    |
    */
}
