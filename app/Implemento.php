<?php

namespace App;

use App\Scopes\ImplementoScope;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class Implemento extends Model
{
    use Uuids;

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    /*protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ImplementoScope);
    }*/

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
        return $this->belongsToMany(SubGrado::class);
    }

    /**
     * Implementos tienen muchos estudiantes.
     *
     * @return Model
     */
    public function estudiantes()
    {
        return $this->belongsToMany(Estudiante::class)->withPivot('cant_util');
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

    /**
     * Scope nombre util
     * @param collection $query
     * @param string $nomb_util
     * @return collection
     */
    public function scopeUtil($query, $nomb_util)
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
