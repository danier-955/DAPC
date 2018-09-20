<?php

namespace App;

use App\Scopes\SeguimientoScope;
use App\Traits\DatesTranslator;
use App\Traits\Uuids;
use Carbon\Carbon;
use Facades\App\Facades\SpecialRole;
use Caffeinated\Shinobi\Facades\Shinobi;
use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    use Uuids, DatesTranslator;

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new SeguimientoScope);
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'docente_practicante';

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
        'fech_segu', 'hora_lleg', 'hora_sali', 'acti_real', 'hora_cump', 'obse_segu',
        'docente_id', 'practicante_id',
    ];

    /**
     * The attributes dates.
     *
     * @var array
     */
    protected $dates = [
        'fech_segu',
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
    public function setFechSeguAttribute($value)
    {
        $this->attributes['fech_segu'] = Carbon::parse($value);
    }

    /*
    |----------------------------------------------------------------------
    | Relaciones
    |----------------------------------------------------------------------
    |
    */

    /**
     * Seguimiento tiene un docente.
     *
     * @return Model
     */
    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }

    /**
     * Seguimiento tiene un practicante.
     *
     * @return Model
     */
    public function practicante()
    {
        return $this->belongsTo(Practicante::class);
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
     * Devuelve el nombre del practicante
     *
     * @return string
     */
    public function getPracticante()
    {
        if (!is_null($this->practicante))
        {
            return "{$this->practicante->nomb_prac} {$this->practicante->pape_prac} {$this->practicante->sape_prac}";
        }
    }

    /*
    |----------------------------------------------------------------------
    | Scopes
    |----------------------------------------------------------------------
    |
    */

    /**
     * Scope fecha
     * @param collection $query
     * @param date $fech_inic
     * @param date $fech_fina
     * @return collection
     */
    public function scopeFecha($query, $fech_inic, $fech_fina)
    {
        if (isset($fech_inic, $fech_fina))
        {
            $fech_inic = Carbon::parse($fech_inic)->toDateString();
            $fech_fina = Carbon::parse($fech_fina)->toDateString();

            return $query->whereBetween('fech_segu', [$fech_inic, $fech_fina]);
        }
    }

    /**
     * Scope usuario autenticado
     * @param collection $query
     * @return collection
     */
    public function scopeAutenticado($query)
    {
        if (Shinobi::isRole(SpecialRole::docente()))
        {
            $usuario = auth()->user()->load('docente');

            if (! is_null($usuario->docente))
            {
                return $query->where('docente_id', $usuario->docente->id);
            }
        }
    }

}
