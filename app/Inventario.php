<?php

namespace App;

use App\Scopes\InventarioScope;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use Uuids;

    // /**
    //  * Global scope
    //  * @return void
    //  */
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::addGlobalScope(new InventarioScope);
    // }

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
        return $this->belongsToMany(Mesa::class)->withPivot('cant_desc', 'esta_desc');
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
        if (!is_null($this->implemento))
        {
            return $this->implemento->nomb_util;
        }
    }
    /**
     * Devuelve el nombre del implemento
     *
  /**
     * Devuelve el nombre del acudiente
     *
     * @return string
     */
    public function getAdministrativo()
    {
        if (!is_null($this->Administrativo))
        {
            return "{$this->Administrativo->nomb_admi} {$this->Administrativo->pape_admi} {$this->Administrativo->sape_admi}";
        }
    }

    /*
    |----------------------------------------------------------------------
    | Scopes
    |----------------------------------------------------------------------
    |
    */
    
    /**
     * Scope sub grado
     * @param collection $query
     * @param string $estudiante_id
     * @return collection
     */
    public function scopeEstudiante($query, $estudiante_id)
    {
        if (isset($estudiante_id))
        {
            return $query->where('estudiante_id', $estudiante_id);
        }
    }

}
