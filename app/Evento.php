<?php

namespace App;

use App\Scopes\EventoScope;
use App\Traits\DatesTranslator;
use App\Traits\Uuids;
use Caffeinated\Shinobi\Facades\Shinobi;
use Carbon\Carbon;
use Facades\App\Facades\SpecialRole;
use Facades\App\Facades\Visible;
use Facades\App\Facades\Jornada;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
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

        static::addGlobalScope(new EventoScope);
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
        'titu_even', 'foto_even', 'inic_even', 'fina_even', 'cupo_even', 'jorn_even',
        'most_even', 'desc_even', 'administrativo_id',
    ];

    /**
     * The attributes dates.
     *
     * @var array
     */
    protected $dates = [
        'inic_even', 'fina_even',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'most_even' => 'string',
        'jorn_even' => 'string',
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
    public function setInicEvenAttribute($value)
    {
        $this->attributes['inic_even'] = Carbon::parse($value);
    }

    /**
     * Convierte el string a fecha al momento de guardar.
     *
     * @var value
     * @return void
     */
    public function setFinaEvenAttribute($value)
    {
        $this->attributes['fina_even'] = Carbon::parse($value);
    }

    /*
    |----------------------------------------------------------------------
    | Relaciones
    |----------------------------------------------------------------------
    |
    */

    /**
     * Evento tiene un administrativo.
     *
     * @return Model
     */
    public function administrativo()
    {
        return $this->belongsTo(Administrativo::class);
    }

    /**
     * Eventos tienen muchos alumnos.
     *
     * @return Model
     */
    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class);
    }

    /**
     * Eventos tienen muchos pagos.
     *
     * @return Model
     */
    public function pagos()
    {
        return $this->belongsToMany(Pago::class);
    }

    /*
    |----------------------------------------------------------------------
    | Métodos
    |----------------------------------------------------------------------
    |
    */

    /**
     * Devuelve true si la galeria es visible
     *
     * @return boolean
     */
    public function esVisible()
    {
        return $this->most_even === Visible::visible();
    }

    /**
     * Devuelve true si la galeria no es visible
     *
     * @return boolean
     */
    public function noEsVisible()
    {
        return ! $this->esVisible();
    }

    /**
     * Devuelve el nombre de acuerdo a la visibilidad de la imagen
     *
     * @return string
     */
    public function getVisibleTitulo()
    {
        return optional(Visible::find($this->most_even))['texto'];
    }

    /**
     * Devuelve el color de acuerdo a la visibilidad de la imagen
     *
     * @return string
     */
    public function getVisibleColor()
    {
        return Visible::getColor($this->most_even);
    }

    /**
     * Devuelve el nombre del administrativo
     *
     * @return string
     */
    public function getAdministrativo()
    {
        if (! is_null($this->administrativo))
        {
            return "{$this->administrativo->nomb_admi} {$this->administrativo->pape_admi} {$this->administrativo->sape_admi}";
        }
    }

    /**
     * Devuelve el nombre de la jornada
     *
     * @return string
     */
    public function getJornada()
    {
        return optional(Jornada::find($this->jorn_even))['texto'];
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
     * @param string $titu_even
     * @return collection
     */
    public function scopeTitulo($query, $titu_even)
    {
        if (isset($titu_even))
        {
            return $query->where('titu_even', 'LIKE', "%{$titu_even}%");
        }
    }

    /**
     * Scope mostrada en principal
     * @param collection $query
     * @param string $most_even
     * @return collection
     */
    public function scopeMostrada($query, $most_even)
    {
        if (isset($most_even) && $most_even)
        {
            return $query->where('most_even', Visible::visible());
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
            return $query->whereBetween('inic_even', [$fech_inic, $fech_fina])
                        ->orWhere(function ($query) use ($fech_inic, $fech_fina)
                        {
                            $query->where('inic_even', '<=', $fech_inic)
                                ->where('fina_even', '>=', $fech_fina);
                        })
                        ->orWhere(function ($query) use ($fech_inic, $fech_fina)
                        {
                            $query->whereBetween('fina_even', [$fech_inic, $fech_fina]);
                        });
        }
    }

    /**
     * Scope usuario autenticado
     * @param collection $query
     * @return collection
     */
    public function scopeAutenticado($query)
    {
        if (Shinobi::isRole(SpecialRole::coordinador()))
        {
            return $query->where('administrativo_id', administrativo('id'));
        }
    }

    /**
     * Scope jornada usuario
     * @param collection $query
     * @return collection
     */
    public function scopeJornada($query)
    {
        if (auth()->user()->esAdministrativo())
        {
            $jorn_admi = administrativo('jorn_admi');

            if ($jorn_admi !== Jornada::todas())
            {
                return $query->where('jorn_even', $jorn_admi);
            }
        }
    }

}
