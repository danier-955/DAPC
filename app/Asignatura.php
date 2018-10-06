<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
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
        'nomb_asig','inte_hora', 'peso_asig', 'log1_asig', 'log2_asig', 'log3_asig', 'log4_asig',
        'area_id', 'docente_id', 'grado_id',
    ];

    /*
    |----------------------------------------------------------------------
    | Relaciones
    |----------------------------------------------------------------------
    |
    */

    /**
     * Asignatura tienen una area.
     *
     * @return Model
     */
    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    /**
     * Asignatura tienen un docente.
     *
     * @return Model
     */
    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }

    /**
     * Asignatura tienen un grado.
     *
     * @return Model
     */
    public function grado()
    {
        return $this->belongsTo(Grado::class);
    }

    /**
     * Asignaturas tienen muchas asistencias.
     *
     * @return Model
     */
    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }

    /**
     * Asignaturas tienen muchas notas.
     *
     * @return Model
     */
    public function notas()
    {
        return $this->hasMany(Nota::class);
    }

    /**
     * Asignaturas tienen muchas fechas extras de notas.
     *
     * @return Model
     */
    public function fechas()
    {
        return $this->belongsToMany(Fecha::class)
                    ->using(AsignaturaFecha::class)
                    ->withPivot('id', 'fech_nota', 'peri_nota', 'moti_nota', 'tipo_nota',
                        'asignatura_id', 'fecha_id')
                    ->orderByDesc('fech_nota->fech_inic')
                    ->orderByDesc('fech_nota->fech_fina')
                    ->orderBy('tipo_nota')
                    ->orderBy('peri_nota')
                    ->withTimestamps();
    }

    /*
    |----------------------------------------------------------------------
    | Métodos
    |----------------------------------------------------------------------
    |
    */

    /**
     * Devuelve el nombre del docente
     *
     * @return string
     */
    public function getDocente()
    {
        if (!is_null($this->docente))
        {
            return "{$this->docente->nomb_doce} {$this->docente->pape_doce} {$this->docente->sape_doce}";
        }
    }

    /**
     * Devuelve el nombre del Grado
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
     * Devuelve el nombre del Area
     *
     * @return string
     */
    public function getArea()
    {
        if (!is_null($this->area))
        {
            return $this->area->nomb_area;
        }

    }

    /*
    |----------------------------------------------------------------------
    | Scopes
    |----------------------------------------------------------------------
    |
    */

    /**
     * Scope nombre asignatura
     * @param collection $query
     * @param string $nomb_asig
     * @return collection
     */
    public function scopeNombre($query, $nomb_asig)
    {
        if (isset($nomb_asig))
        {
            return $query->where('nomb_asig', 'LIKE', "%{$nomb_asig}%");
        }
    }

    /**
     * Scope area ID
     * @param collection $query
     * @param string $area_id
     * @return collection
     */
    public function scopeArea($query, $area_id)
    {
        if (isset($area_id))
        {
            return $query->where('area_id', $area_id);
        }
    }

    /**
     * Scope grado ID
     * @param collection $query
     * @param string $grado_id
     * @return collection
     */
    public function scopeGrado($query, $grado_id)
    {
        if (isset($grado_id))
        {
            return $query->where('grado_id', $grado_id);
        }
    }

}
