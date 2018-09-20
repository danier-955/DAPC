<?php

namespace App;

use App\Scopes\CalendarioScope;
use App\Traits\Uuids;
use Caffeinated\Shinobi\Facades\Shinobi;
use Carbon\Carbon;
use Facades\App\Facades\Jornada;
use Facades\App\Facades\SpecialRole;
use Illuminate\Database\Eloquent\Model;

class Calendario extends Model
{
    use Uuids;

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new CalendarioScope);
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
        'titu_cale', 'fech_inic', 'fech_fina', 'desc_cale', 'fina_cale', 'jorn_cale',
        'administrativo_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'jorn_cale' => 'string',
    ];

    /**
     * The attributes dates.
     *
     * @var array
     */
    protected $dates = [
        'fech_inic', 'fech_fina',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'color'
    ];

    /*
    |----------------------------------------------------------------------
    | Accesores
    |----------------------------------------------------------------------
    |
    */

    /**
     * Obtiene un color para cada evento del calendario en el atributo backgroundColor.
     *
     * @return bool
     */
    public function getColorAttribute()
    {
        return $this->attributes['color'] = $this->getBackgroundColor();
    }

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
    public function setFechInicAttribute($value)
    {
        $this->attributes['fech_inic'] = Carbon::parse($value);
    }

    /**
     * Convierte el string a fecha al momento de guardar.
     *
     * @var value
     * @return void
     */
    public function setFechFinaAttribute($value)
    {
        $this->attributes['fech_fina'] = Carbon::parse($value);
    }

    /*
    |----------------------------------------------------------------------
    | Relaciones
    |----------------------------------------------------------------------
    |
    */

    /**
     * Calendario tiene un administrativo.
     *
     * @return Model
     */
    public function administrativo()
    {
        return $this->belongsTo(Administrativo::class);
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
        return optional(Jornada::find($this->jorn_cale))['texto'];
    }

    /**
     * Obtiene un color aleatorio.
     *
     * @return bool
     */
    protected function getBackgroundColor()
    {

        $colors = array('#ffc107', '#2196f3', '#607d8b', '#795548', '#00bcd4', '#ff5722', '#673ab7',
            '#4caf50', '#9e9e9e', '#3f51b5', '#03a9f4', '#8bc34a', '#ff9800', '#e91e63', '#9c27b0',
            '#f44336', '#009688', '#fdd835', '#9c27b0', '#ff4081', '#f44336', '#2196f3', '#4caf50',
            '#ff9800', '#424242');

        return $colors[array_rand($colors)];
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
            $fech_inic = Carbon::createFromTimestampMs($fech_inic)->format('Y-m-d');
            $fech_fina = Carbon::createFromTimestampMs($fech_fina)->format('Y-m-d');

            return $query->whereBetween('fech_inic', [$fech_inic, $fech_fina])
                        ->orWhere(function ($query) use ($fech_inic, $fech_fina)
                        {
                            $query->where('fech_inic', '<=', $fech_inic)
                                ->where('fech_fina', '>=', $fech_fina);
                        })
                        ->orWhere(function ($query) use ($fech_inic, $fech_fina)
                        {
                            $query->whereBetween('fech_fina', [$fech_inic, $fech_fina]);
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
                return $query->where('jorn_cale', $jorn_admi);
            }
        }
    }

}
