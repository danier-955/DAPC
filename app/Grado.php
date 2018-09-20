<?php

namespace App;

use App\Traits\Uuids;
use Facades\App\Facades\Jornada;
use Illuminate\Database\Eloquent\Model;

class Grado extends Model
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
        'nomb_grad', 'abre_grad', 'jorn_grad',
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
     * Grados tienen muchos subgrados.
     *
     * @return Model
     */
    public function subGrados()
    {
        return $this->hasMany(SubGrado::class)->orderBy('abre_subg');
    }

    /**
     * Grados tienen muchas asignaturas.
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

    /**
     * Devuelve el nombre de la jornada
     *
     * @return string
     */
    public function getJornada()
    {
        return optional(Jornada::find($this->jorn_grad))['texto'];
    }

    /*
    |----------------------------------------------------------------------
    | Scopes
    |----------------------------------------------------------------------
    |
    */

}
