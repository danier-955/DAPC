<?php

namespace App;

use App\Scopes\PlaneamientoScope;
use App\Traits\DatesTranslator;
use App\Traits\Uuids;
use Carbon\Carbon;
use Facades\App\Facades\SpecialRole;
use Caffeinated\Shinobi\Facades\Shinobi;
use Illuminate\Database\Eloquent\Model;

class Planeamiento extends Model
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

        static::addGlobalScope(new PlaneamientoScope);
    }

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
        'titu_plan', 'fech_plan', 'desc_plan', 'docu_plan', 'docente_id',
    ];

    /**
     * The attributes dates.
     *
     * @var array
     */
    protected $dates = [
        'fech_plan',
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
    public function setFechPlanAttribute($value)
    {
        $this->attributes['fech_plan'] = Carbon::parse($value);
    }

    /*
    |----------------------------------------------------------------------
    | Relaciones
    |----------------------------------------------------------------------
    |
    */

    /**
     * Planeamiento tiene un docente.
     *
     * @return Model
     */
    public function docente()
    {
        return $this->belongsTo(Docente::class);
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

    /*
    |----------------------------------------------------------------------
    | Scopes
    |----------------------------------------------------------------------
    |
    */

    /**
     * Scope titulo
     * @param collection $query
     * @param string $titu_plan
     * @return collection
     */
    public function scopeTitulo($query, $titu_plan)
    {
        if (isset($titu_plan))
        {
            return $query->where('titu_plan', 'LIKE', "%{$titu_plan}%");
        }
    }

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

            return $query->whereBetween('fech_plan', [$fech_inic, $fech_fina]);
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
