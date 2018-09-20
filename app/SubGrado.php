<?php

namespace App;

use App\Scopes\SubGradoScope;
use App\Traits\Uuids;
use Facades\App\Facades\Jornada;
use Illuminate\Database\Eloquent\Model;

class SubGrado extends Model
{
    use Uuids;

    /**
     * Global scope
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new SubGradoScope);
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
        return $this->hasMany(Implemento::class);
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
        return $this->belongsToMany(Docente::class);
    }

    /**
     * Subgrados tienen muchos practicantes.
     *
     * @return Model
     */
    public function practicantes()
    {
        return $this->belongsToMany(Practicante::class);
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
            return optional($this->grado)->abre_grad . '&middot; Jornada ' . optional($this->grado)->getJornada();
        }
    }

    /**
     * Devuelve el nombre del subGrado
     *
     * @return string
     */
    public function getGradoNombre()
    {
        if (!is_null($this->grado))
        {
            $subGrado = $this->grado->first();
            $grado = $subGrado->grado;

            return optional($grado)->abre_grad . ' &middot; ' . $subGrado->abre_subg . ' &middot; Jornada '. optional($grado)->getJornada();
        }
    }

    /**
     * Devuelve el id del subGrado
     *
     * @return string
     */
    public function getSubGradoId()
    {
        if (!is_null($this->subGrados))
        {
            return $this->subGrados->first()->id;
        }

    }

    /**
     * Devuelve el id del director
     *
     * @return string
     */
    public function getDirectorId()
    {
        if (is_null($this->docentes))
        {
            return $this->docentes->first()->id;
        }else{
            return 'Sin director de Grupo';
        }

    }

    /**
     * Devuelve el nombre del director
     *
     * @return string
     */
    public function getDirectorNombre()
    {   
        if (!is_null($this->docentes))           
        {
            $docente = $this->docentes->first();

            return optional($docente)->nomb_doce .' '. optional($docente)->pape_doce .' '. optional($docente)->sape_doce;
        }else{
            return '··· Sin director ···';        
        }

    }

    /*
    |----------------------------------------------------------------------
    | Scopes
    |----------------------------------------------------------------------
    |
    */

}
