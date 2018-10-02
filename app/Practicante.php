<?php

namespace App;

use App\Traits\DatesTranslator;
use App\Traits\Uuids;
use Carbon\Carbon;
use Facades\App\Facades\Sexo;
use Illuminate\Database\Eloquent\Model;

class Practicante extends Model
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
        'tipo_docu', 'docu_prac', 'nomb_prac', 'pape_prac', 'sape_prac', 'sexo_prac',
        'dire_prac', 'barr_prac', 'corr_prac', 'tele_prac', 'padr_prac', 'madr_prac',
        'cole_prov', 'seme_curs', 'hora_paga', 'inic_prac', 'fina_prac', 'obse_prac',
    ];

    /**
     * The attributes dates.
     *
     * @var array
     */
    protected $dates = [
        'inic_prac', 'fina_prac',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'sexo_prac' => 'string',
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
    public function setInicPracAttribute($value)
    {
        $this->attributes['inic_prac'] = Carbon::parse($value);
    }

    /**
     * Convierte el string a fecha al momento de guardar.
     *
     * @var value
     * @return void
     */
    public function setFinaPracAttribute($value)
    {
        $this->attributes['fina_prac'] = Carbon::parse($value);
    }

    /*
    |----------------------------------------------------------------------
    | Relaciones
    |----------------------------------------------------------------------
    |
    */

    /**
     * Practicantes tienen muchos subGrados.
     *
     * @return Model
     */
    public function subGrados()
    {
        return $this->belongsToMany(SubGrado::class)->withTimestamps();
    }

    /**
     * Practicantes tienen muchos docentes.
     *
     * @return Model
     */
    public function docentes()
    {
        return $this->belongsToMany(Docente::class)
                    ->withPivot('id', 'fech_segu', 'hora_lleg', 'hora_sali', 'acti_real', 'hora_cump', 'obse_segu')
                    ->orderBy('fech_segu')
                    ->orderByDesc('created_at')
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
        return optional(Sexo::find($this->sexo_prac))['texto'];
    }

    /**
     * Devuelve el nombre del subGrado
     *
     * @return string
     */
    public function getSubGradoNombre()
    {
        if (!is_null($this->subGrados))
        {
            $subGrado = $this->subGrados->first();
            $grado = $subGrado->grado;

            return optional($grado)->abre_grad . ' &middot; ' . $subGrado->abre_subg . ' &middot; Jornada '. optional($grado)->getJornada();
        }

    }

    /**
     * Devuelve el id del subGrado
     *
     * @return string
     */
    public function getSubGradoId()
    {
        if (!is_null($this->subGrados))
        {
            return $this->subGrados->first()->id;
        }

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
     * @param integer $docu_prac
     * @return collection
     */
    public function scopeDocumento($query, $docu_prac)
    {
        if (isset($docu_prac))
        {
            return $query->where('docu_prac', 'LIKE', "%{$docu_prac}%");
        }
    }

    /**
     * Scope nombre
     * @param collection $query
     * @param string $nomb_prac
     * @return collection
     */
    public function scopeNombre($query, $nomb_prac)
    {
        if (isset($nomb_prac))
        {
            return $query->where('nomb_prac', 'LIKE', "%{$nomb_prac}%");
        }
    }

    /**
     * Scope primer apellido
     * @param collection $query
     * @param string $pape_prac
     * @return collection
     */
    public function scopePrimerApellido($query, $pape_prac)
    {
        if (isset($pape_prac))
        {
            return $query->where('pape_prac', 'LIKE', "%{$pape_prac}%");
        }
    }

    /**
     * Scope segundo apellido
     * @param collection $query
     * @param string $sape_prac
     * @return collection
     */
    public function scopeSegundoApellido($query, $sape_prac)
    {
        if (isset($sape_prac))
        {
            return $query->where('sape_prac', 'LIKE', "%{$sape_prac}%");
        }
    }

}
