<?php

namespace App;

use App\Traits\Uuids;
use Carbon\Carbon;
use Facades\App\Facades\Sexo;
use Facades\App\Facades\Parentesco;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
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
        'tipo_docu', 'docu_alum', 'nomb_alum', 'pape_alum', 'sape_alum', 'sexo_alum',
        'fech_naci', 'dire_alum', 'barr_alum', 'corr_alum', 'tele_alum', 'nomb_acud',
        'pare_acud', 'obse_alum',
    ];

    /**
     * The attributes dates.
     *
     * @var array
     */
    protected $dates = [
        'fech_naci',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'sexo_alum' => 'string',
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
    public function setFechNaciAttribute($value)
    {
        $this->attributes['fech_naci'] = Carbon::parse($value);
    }

    /*
    |----------------------------------------------------------------------
    | Relaciones
    |----------------------------------------------------------------------
    |
    */

    /**
     * Alumnos tienen muchos eventos.
     *
     * @return Model
     */
    public function eventos()
    {
        return $this->belongsToMany(Evento::class)
                    ->orderBy('titu_even')
                    ->withTimestamps();
    }

    /**
     * Alumnos tienen muchos programas.
     *
     * @return Model
     */
    public function programas()
    {
        return $this->belongsToMany(Programa::class)
                    ->orderBy('nomb_prog')
                    ->withTimestamps();
    }

    /*
    |----------------------------------------------------------------------
    | Métodos
    |----------------------------------------------------------------------
    |
    */

    /**
     * Devuelve el nombre del sexo
     *
     * @return string
     */
    public function getSexo()
    {
        return optional(Sexo::find($this->sexo_alum))['texto'];
    }

    /**
     * Devuelve el nombre del sexo
     *
     * @return string
     */
    public function getParentesco()
    {
        return optional(Parentesco::find($this->sexo_alum))['texto'];
    }

    /**
     * Devuelve el id del programa intersectado
     * @param string $programaId
     * @return string
     */
    public function getProgramaId($programaId)
    {
        return head(optional($this->programas)->pluck('id')->intersect($programaId)->values()->toArray());
    }

    /*
    |----------------------------------------------------------------------
    | Scopes
    |----------------------------------------------------------------------
    |
    */
    /**
     * Scope documento
     * @param collection $query
     * @param integer $docu_alum
     * @return collection
     */
    public function scopeDocumento($query, $docu_alum)
    {
        if (isset($docu_alum))
        {
            return $query->where('docu_alum', 'LIKE', "%{$docu_alum}%");
        }
    }

    /**
     * Scope nombre
     * @param collection $query
     * @param string $nomb_alum
     * @return collection
     */
    public function scopeNombre($query, $nomb_alum)
    {
        if (isset($nomb_alum))
        {
            return $query->where('nomb_alum', 'LIKE', "%{$nomb_alum}%");
        }
    }

    /**
     * Scope primer apellido
     * @param collection $query
     * @param string $pape_alum
     * @return collection
     */
    public function scopePrimerApellido($query, $pape_alum)
    {
        if (isset($pape_alum))
        {
            return $query->where('pape_alum', 'LIKE', "%{$pape_alum}%");
        }
    }

    /**
     * Scope acudiente
     * @param collection $query
     * @param string $nomb_acud
     * @return collection
     */
    public function scopeAcudiente($query, $nomb_acud)
    {
        if (isset($nomb_acud))
        {
            return $query->where('nomb_acud', 'LIKE', "%{$nomb_acud}%");
        }
    }

}
