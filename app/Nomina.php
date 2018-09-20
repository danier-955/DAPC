<?php

namespace App;

use App\Scopes\NominaScope;
use App\Traits\Uuids;
use Facades\App\Facades\TipoNomina;
use Illuminate\Database\Eloquent\Model;

class Nomina extends Model
{
    use Uuids;

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new NominaScope);
    }

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
        'tota_nomi', 'tota_mora', 'pago_nomi', 'quin_nomi', 'mes_nomi', 'ano_nomi',
        'pago_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'pago_nomi' => 'string',
        'quin_nomi' => 'string',
    ];

    /*
    |----------------------------------------------------------------------
    | Relaciones
    |----------------------------------------------------------------------
    |
    */

    /**
     * Nomina tiene un pago.
     *
     * @return Model
     */
    public function pago()
    {
        return $this->belongsTo(Pago::class);
    }

    /**
     * Nomina tiene muchos empleados.
     *
     * @return Model
     */
    public function empleados()
    {
        return $this->belongsToMany(Empleado::class);
    }

    /**
     * Nomina tiene muchos estudiantes.
     *
     * @return Model
     */
    public function estudiantes()
    {
        return $this->belongsToMany(Estudiante::class);
    }

    /*
    |----------------------------------------------------------------------
    | Métodos
    |----------------------------------------------------------------------
    |
    */

    /**
     * Devuelve el nombre el tipo de pago de la nomina
     *
     * @return string
     */
    public function getPagoNomina()
    {
        return optional(TipoNomina::find($this->pago_nomi))['texto'];
    }

    /**
     * Devuelve el nombre de la quincena de la nomina
     *
     * @return string
     */
    public function getQuincena()
    {
        return optional(TipoNomina::findQuincena($this->quin_nomi))['texto'];
    }

    /*
    |----------------------------------------------------------------------
    | Scopes
    |----------------------------------------------------------------------
    |
    */
}
