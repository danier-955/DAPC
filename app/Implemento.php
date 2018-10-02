<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class Implemento extends Model
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
        'nomb_util', 'desc_util',
    ];

    /*
    |----------------------------------------------------------------------
    | Relaciones
    |----------------------------------------------------------------------
    |
    */

    /**
     * Implementos tienen muchos subGrados.
     *
     * @return Model
     */
    public function subGrados()
    {
        return $this->belongsToMany(SubGrado::class)->withTimestamps();
    }

    /**
     * Implementos tienen muchos estudiantes.
     *
     * @return Model
     */
    public function estudiantes()
    {
        return $this->belongsToMany(Estudiante::class)
                    ->using(EstudianteImplemento::class)
                    ->withPivot('id', 'cant_util', 'ano_util')
                    ->orderBy('nomb_estu')
                    ->orderBy('pape_estu')
                    ->withTimestamps();
    }

    /**
     * Implementos tienen muchos inventarios.
     *
     * @return Model
     */
    public function inventarios()
    {
        return $this->hasMany(Inventario::class);
    }


    /*
    |----------------------------------------------------------------------
    | Métodos
    |----------------------------------------------------------------------
    |
    */

    /**
     * Devuelve el nombre de los administrativos
     *
     * @return string
     */
    public function getAdministrativos()
    {
        if ($this->inventarios->isNotEmpty())
        {
            $administrativos = collect();

            foreach ($this->inventarios as $inventario)
            {
                if (! is_null($inventario->administrativo))
                {
                    $administrativos->push("{$inventario->administrativo->nomb_admi} {$inventario->administrativo->pape_admi} {$inventario->administrativo->sape_admi}");
                }
            }

            return $administrativos->unique()->values()->implode(', ');
        }
    }

    /**
     * Devuelve el id del subgrado intersectado
     * @param string $subgradoId
     * @return string
     */
    public function getSubGradoId($subgradoId)
    {
        return head(optional($this->subGrados)->pluck('id')->intersect($subgradoId)->values()->toArray());
    }

    /*
    |----------------------------------------------------------------------
    | Scopes
    |----------------------------------------------------------------------
    |
    */

    /**
     * Scope nombre util
     * @param collection $query
     * @param string $nomb_util
     * @return collection
     */
    public function scopeNombre($query, $nomb_util)
    {
        if (isset($nomb_util))
        {
            return $query->where('nomb_util', 'LIKE', "%{$nomb_util}%");
        }
    }


    /**
     * Scope sub grado ID
     * @param collection $query
     * @param string $subGrado
     * @return collection
     */
    public function scopeSubGrado($query, $subGrado)
    {
        if (isset($subGrado))
        {
            return $query->whereHas('subGrados', function ($query) use ($subGrado) {
                            return $query->where('id', $subGrado);
                        });
        }
    }

    /**
     * Scope estudiante ID
     * @param collection $query
     * @param string $estudiante_id
     * @return collection
     */
    /*public function scopeEstudiante($query, $estudiante_id)
    {
        if (isset($estudiante_id))
        {
            return $query->where('estudiante_id', $estudiante_id);
        }
    }*/

}
