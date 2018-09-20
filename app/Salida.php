<?php

namespace App;

use App\Scopes\SalidaScope;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class Salida extends Model
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

        static::addGlobalScope(new SalidaScope);
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
        'fech_sali', 'fech_regr', 'luga_dest', 'mesa_id',
    ];

    /**
     * The attributes dates.
     *
     * @var array
     */
    protected $dates = [
        'fech_sali', 'fech_regr',
    ];

    /*
    |----------------------------------------------------------------------
    | Relaciones
    |----------------------------------------------------------------------
    |
    */

    /**
     * Salida tiene una mesa.
     *
     * @return Model
     */
    public function mesa()
    {
        return $this->belongsTo(Mesa::class);
    }

    /**
     * Salidas tienen muchos pagos.
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
