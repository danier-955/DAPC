<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
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
        'stoc_inve', 'administrativo_id', 'implemento_id',
    ];

    /*
    |----------------------------------------------------------------------
    | Relaciones
    |----------------------------------------------------------------------
    |
    */

    /**
     * Inventario tiene un administrativo.
     *
     * @return Model
     */
    public function administrativo()
    {
        return $this->belongsTo(Administrativo::class);
    }

    /**
     * Inventario tiene un implemento.
     *
     * @return Model
     */
    public function implemento()
    {
        return $this->belongsTo(Implemento::class);
    }

    /**
     * Inventarios tienen muchas mesas.
     *
     * @return Model
     */
    public function mesas()
    {
        return $this->belongsToMany(Mesa::class)
                    ->withPivot('cant_desc', 'esta_desc')
                    ->orderBy('esta_desc')
                    ->withTimestamps();
    }

    /*
    |----------------------------------------------------------------------
    | Métodos
    |----------------------------------------------------------------------
    |
    */

    /**
     * Devuelve el nombre del implemento
     *
     * @return string
     */
    public function getImplemento()
    {
        if (! is_null($this->implemento))
        {
            return $this->implemento->nomb_util;
        }
    }

    /**
     * Devuelve el nombre del administrativo
     *
     * @return string
     */
    public function getAdministrativo()
    {
        if (! is_null($this->administrativo))
        {
            return "{$this->administrativo->nomb_admi} {$this->administrativo->pape_admi} {$this->administrativo->sape_admi}";
        }
    }

    /*
    |----------------------------------------------------------------------
    | Scopes
    |----------------------------------------------------------------------
    |
    */

}
