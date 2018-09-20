<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\EstudianteImplementoScope;

class EstudianteImplemento extends Model
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

        static::addGlobalScope(new EstudianteImplementoScope);
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'estudiante_implemento';

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
        'cant_util', 'estudiante_id', 'implemento_id',
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