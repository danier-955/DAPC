<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Support\Str;
use Facades\App\Facades\Jornada;
use Illuminate\Database\Eloquent\Model;

class SubGrado extends Model
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
        'abre_subg', 'cant_estu', 'grado_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'jorn_grad' => 'string',
    ];

    /*
    |----------------------------------------------------------------------
    | Mutadores
    |----------------------------------------------------------------------
    |
    */

    /**
     * Convierte la abreviación a mayuscula al momento de guardar.
     *
     * @var value
     * @return void
     */
    public function setAbreSubgAttribute($value)
    {
        $this->attributes['abre_subg'] = Str::upper($value);
    }

    /*
    |----------------------------------------------------------------------
    | Relaciones
    |----------------------------------------------------------------------
    |
    */

    /**
     * Subgrado tiene un grado.
     *
     * @return Model
     */
    public function grado()
    {
        return $this->belongsTo(Grado::class);
    }

    /**
     * Subgrados tienen muchos estudiantes.
     *
     * @return Model
     */
    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class);
    }

    /**
     * Subgrados tienen muchos implementos.
     *
     * @return Model
     */
    public function implementos()
    {
        return $this->hasMany(Implemento::class)->withTimestamps();
    }

    /**
     * Subgrados tienen muchas mesas.
     *
     * @return Model
     */
    public function mesas()
    {
        return $this->hasMany(Mesa::class);
    }

    /**
     * Subgrados tienen muchos docentes.
     *
     * @return Model
     */
    public function docentes()
    {
        return $this->belongsToMany(Docente::class)->withTimestamps();
    }

    /**
     * Subgrados tienen muchos practicantes.
     *
     * @return Model
     */
    public function practicantes()
    {
        return $this->belongsToMany(Practicante::class)->withTimestamps();
    }

    /*
    |----------------------------------------------------------------------
    | Métodos
    |----------------------------------------------------------------------
    |
    */

    /**
     * Devuelve el nombre de la jornada
     *
     * @return string
     */
    public function getJornada()
    {
        return optional(Jornada::find($this->jorn_grad))['texto'];
    }

    /**
     * Devuelve el nombre del grado
     *
     * @return string
     */
    public function getGrado()
    {
        if (!is_null($this->grado))
        {
            return "{$this->grado->abre_grad} &middot; Jornada {$this->grado->getJornada()}";
        }
    }

    /**
     * Devuelve el id del director
     *
     * @return string
     */
    public function getDirectorId()
    {
        if ($this->docentes->isNotEmpty())
        {
            return $this->docentes->first()->id;
        }
    }

    /**
     * Devuelve el nombre del director
     *
     * @return string
     */
    public function getDirectorNombre()
    {
        if ($this->docentes->isNotEmpty())
        {
            $docente = $this->docentes->first();

            return "{$docente->nomb_doce} {$docente->pape_doce} {$docente->sape_doce}";
        }

        return '··· Sin director ···';
    }

    /*
    |----------------------------------------------------------------------
    | Scopes
    |----------------------------------------------------------------------
    |
    */

}
