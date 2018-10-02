<?php

namespace App;

use App\Traits\DatesTranslator;
use App\Traits\Uuids;
use Caffeinated\Shinobi\Facades\Shinobi;
use Facades\App\Facades\SpecialRole;
use Facades\App\Facades\Visible;
use Facades\App\Facades\Jornada;
use Illuminate\Database\Eloquent\Model;

class Galeria extends Model
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
        'titu_gale', 'foto_gale', 'desc_gale', 'most_gale', 'jorn_gale', 'administrativo_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'most_gale' => 'string',
        'jorn_gale' => 'string',
    ];

    /*
    |----------------------------------------------------------------------
    | Relaciones
    |----------------------------------------------------------------------
    |
    */

    /**
     * Galeria tiene un administrativo.
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
     * Devuelve true si la galeria es visible
     *
     * @return boolean
     */
    public function esVisible()
    {
        return $this->most_gale === Visible::visible();
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
        return optional(Visible::find($this->most_gale))['texto'];
    }

    /**
     * Devuelve el color de acuerdo a la visibilidad de la imagen
     *
     * @return string
     */
    public function getVisibleColor()
    {
        return Visible::getColor($this->most_gale);
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
        return optional(Jornada::find($this->jorn_gale))['texto'];
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
     * @param string $titu_gale
     * @return collection
     */
    public function scopeTitulo($query, $titu_gale)
    {
        if (isset($titu_gale))
        {
            return $query->where('titu_gale', 'LIKE', "%{$titu_gale}%");
        }
    }

    /**
     * Scope mostrada en principal
     * @param collection $query
     * @param string $most_gale
     * @return collection
     */
    public function scopeMostrada($query, $most_gale)
    {
        if (isset($most_gale) && $most_gale)
        {
            return $query->where('most_gale', Visible::visible());
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
                return $query->where('jorn_gale', $jorn_admi);
            }
        }
    }

}