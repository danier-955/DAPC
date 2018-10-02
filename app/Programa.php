<?php

namespace App;

use App\Traits\DatesTranslator;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class Programa extends Model
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
        'nomb_prog', 'desc_prog', 'administrativo_id',
    ];

    /*
    |----------------------------------------------------------------------
    | Relaciones
    |----------------------------------------------------------------------
    |
    */

    /**
     * Programa tiene un administrativo.
     *
     * @return Model
     */
    public function administrativo()
    {
        return $this->belongsTo(Administrativo::class);
    }

    /**
     * Programa tienen muchos alumnos.
     *
     * @return Model
     */
    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class)->withTimestamps();
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
     * Scope nombre
     * @param collection $query
     * @param string $nomb_prog
     * @return collection
     */
    public function scopeNombre($query, $nomb_prog)
    {
        if (isset($nomb_prog))
        {
            return $query->where('nomb_prog', 'LIKE', "%{$nomb_prog}%");
        }
    }

}
