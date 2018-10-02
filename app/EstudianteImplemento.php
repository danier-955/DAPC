<?php

namespace App;

use App\Traits\DatesTranslator;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Relations\Pivot;

class EstudianteImplemento extends Pivot
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
        'cant_util', 'ano_util', 'estudiante_id', 'implemento_id',
    ];

    /*
    |----------------------------------------------------------------------
    | Relaciones
    |----------------------------------------------------------------------
    |
    */

    /**
     * Estudiante-Implemento tiene un estudiante.
     *
     * @return Model
     */
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }

    /**
     * Estudiante-Implemento tiene un implemento.
     *
     * @return Model
     */
    public function implemento()
    {
        return $this->belongsTo(Implemento::class);
    }

    /*
    |----------------------------------------------------------------------
    | Métodos
    |----------------------------------------------------------------------
    |
    */

    /**
     * Get the name of the "updated at" column.
     *
     * @return string
     */
    public function getUpdatedAtColumn()
    {
        if ($this->pivotParent) {
            return $this->pivotParent->getUpdatedAtColumn();
        }

        return static::UPDATED_AT;
    }

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
     * Devuelve el nombre del estudiante
     *
     * @return string
     */
    public function getEstudiante()
    {
        if (!is_null($this->estudiante))
        {
            return "{$this->estudiante->nomb_estu} {$this->estudiante->pape_estu} {$this->estudiante->sape_estu}";
        }
    }

    /*
    |----------------------------------------------------------------------
    | Scopes
    |----------------------------------------------------------------------
    |
    */

    /**
     * Scope estudiante
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