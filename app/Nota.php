<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
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
        'codi_nota', 'nota_per1', 'nota_per2', 'nota_per3', 'nota_per4', 'nota_def1',
        'nota_def2', 'nota_def3', 'nota_def4', 'cali_per1', 'cali_per2', 'cali_per3',
        'cali_per4', 'nota_rec1', 'nota_rec2', 'nota_rec3', 'nota_rec4', 'cali_rec1',
        'cali_rec2', 'cali_rec3', 'cali_rec4', 'ano_nota', 'asignatura_id', 'estudiante_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'nota_per1' => 'real',
        'nota_per2' => 'real',
        'nota_per3' => 'real',
        'nota_per4' => 'real',
        'nota_rec1' => 'real',
        'nota_rec2' => 'real',
        'nota_rec3' => 'real',
        'nota_rec4' => 'real',
        'cali_per1' => 'boolean',
        'cali_per2' => 'boolean',
        'cali_per3' => 'boolean',
        'cali_per4' => 'boolean',
        'cali_rec1' => 'boolean',
        'cali_rec2' => 'boolean',
        'cali_rec3' => 'boolean',
        'cali_rec4' => 'boolean',
    ];

    /*
    |----------------------------------------------------------------------
    | Relaciones
    |----------------------------------------------------------------------
    |
    */

    /**
     * Nota tiene una asignatura.
     *
     * @return Model
     */
    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class);
    }

    /**
     * Nota tiene un estudiante.
     *
     * @return Model
     */
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
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

}
