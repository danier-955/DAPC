<?php

namespace App;

use App\Traits\Uuids;
use Carbon\Carbon;
use Facades\App\Facades\Periodo;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
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
        'valo_asis', 'peri_asis', 'fech_asis', 'moti_fall', 'asignatura_id', 'estudiante_id',
    ];

    /**
     * The attributes dates.
     *
     * @var array
     */
    protected $dates = [
        'fech_asis',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'valo_asis' => 'boolean',
        'peri_asis' => 'string',
    ];

    /*
    |----------------------------------------------------------------------
    | Mutadores
    |----------------------------------------------------------------------
    |
    */

    /**
     * Convierte el string a fecha al momento de guardar.
     *
     * @var value
     * @return void
     */
    public function setFechAsisAttribute($value)
    {
        $this->attributes['fech_asis'] = Carbon::parse($value);
    }

    /*
    |----------------------------------------------------------------------
    | Relaciones
    |----------------------------------------------------------------------
    |
    */

    /**
     * Asistencia tiene una asignatura.
     *
     * @return Model
     */
    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class);
    }

    /**
     * Asistencia tiene un estudiante.
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

    /**
     * Devuelve el nombre del periodo
     *
     * @return string
     */
    public function getPeriodo()
    {
        return optional(Periodo::find($this->peri_asis))['texto'];
    }

    /*
    |----------------------------------------------------------------------
    | Scopes
    |----------------------------------------------------------------------
    |
    */

}
