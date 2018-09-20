<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
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
        'nomb_area', 'desc_area',
    ];

    /*
    |----------------------------------------------------------------------
    | Relaciones
    |----------------------------------------------------------------------
    |
    */

    /**
     * Areas tienen muchas asignaturas.
     *
     * @return Model
     */
    public function asignaturas()
    {
        return $this->hasMany(Asignatura::class);
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
     * Scope nombre area
     * @param collection $query
     * @param string $nomb_area
     * @return collection
     */
    public function scopeArea($query, $nomb_area)
    {
        if (isset($nomb_area))
        {
            return $query->where('nomb_area', 'LIKE', "%{$nomb_area}%");
        }
    }

}
