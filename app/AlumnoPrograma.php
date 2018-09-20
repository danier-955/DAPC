<?php

namespace App;

use App\Traits\Uuids;
use App\AlumnoPrograma;
use App\Scopes\AlumnoProgramaScope;
use Illuminate\Database\Eloquent\Model;

class AlumnoPrograma extends Model
{
    use Uuids;

    /**
     * Global scope
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new AlumnoProgramaScope);
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'alumno_programas';

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
        'alumno_id', 'programa_id',
    ];


    /*
    |----------------------------------------------------------------------
    | Mutadores
    |----------------------------------------------------------------------
    |
    */

 
    /*
    |----------------------------------------------------------------------
    | Relaciones
    |----------------------------------------------------------------------
    |
    */

    /**
     * Alumnos tienen muchos Programas  y eventos.
     *
     * @return Model
     */
    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }

     /**
     * Alumnos tienen muchos Programas  y eventos.
     *
     * @return Model
     */
    public function programa()
    {
        return $this->belongsTo(Programa::class);
    }

    /*
    |----------------------------------------------------------------------
    | Métodos
    |----------------------------------------------------------------------
    |
    */

           /**
     * Devuelve el nombre del Programa
     *
     * @return string
     */
    public function getPrograma() 
    {
        if (!is_null($this->programa))
        {
            return "{$this->programa->nomb_prog}";
        }

    }


    /*
    |----------------------------------------------------------------------
    | Scopes
    |----------------------------------------------------------------------
    |
    */
}
