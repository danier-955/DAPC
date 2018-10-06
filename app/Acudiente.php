<?php

namespace App;

use App\Acudiente;
use App\Events\UsuarioRegistrado;
use App\Traits\Uuids;
use Caffeinated\Shinobi\Facades\Shinobi;
use Facades\App\Facades\Sexo;
use Facades\App\Facades\SpecialRole;
use Illuminate\Database\Eloquent\Model;

class Acudiente extends Model
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
        'tipo_docu', 'docu_acud', 'nomb_acud', 'pape_acud', 'sape_acud', 'sexo_acud',
        'dire_acud', 'barr_acud', 'corr_acud', 'tele_acud', 'prof_acud', 'user_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'sexo_acud' => 'string',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => UsuarioRegistrado::class,
    ];

    /*
    |----------------------------------------------------------------------
    | Relaciones
    |----------------------------------------------------------------------
    |
    */

    /**
     * Acudiente tiene un usuario.
     *
     * @return Model
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Acudientes tienen muchos estudiantes.
     *
     * @return Model
     */
    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class);
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
        return optional(Sexo::find($this->sexo_acud))['texto'];
    }

     /**
     * Devuelve el nombre del sexo
     *
     * @return string
     */
    public function getDocumento()
    {
        return optional(Documento::find($this->tipo_docu))['texto'];
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
     * @param integer $docu_acud
     * @return collection
     */
    public function scopeDocumento($query, $docu_acud)
    {
        if (isset($docu_acud))
        {
            return $query->where('docu_acud', 'LIKE', "%{$docu_acud}%");
        }
    }

    /**
     * Scope nombre
     * @param collection $query
     * @param string $nomb_acud
     * @return collection
     */
    public function scopeNombre($query, $nomb_acud)
    {
        if (isset($nomb_acud))
        {
            return $query->where('nomb_acud', 'LIKE', "%{$nomb_acud}%");
        }
    }

    /**
     * Scope primer apellido
     * @param collection $query
     * @param string $pape_acud
     * @return collection
     */
    public function scopePrimerApellido($query, $pape_acud)
    {
        if (isset($pape_acud))
        {
            return $query->where('pape_acud', 'LIKE', "%{$pape_acud}%");
        }
    }

    /**
     * Scope segundo apellido
     * @param collection $query
     * @param string $sape_acud
     * @return collection
     */
    public function scopeSegundoApellido($query, $sape_acud)
    {
        if (isset($sape_acud))
        {
            return $query->where('sape_acud', 'LIKE', "%{$sape_acud}%");
        }
    }

    /**
     * Scope search by ajax
     * @param collection $query
     * @param string $sape_acud
     * @return collection
     */
    public function scopeSearch($query, $sear_acud)
    {
        return $query->where('docu_acud', 'LIKE', "%{$sear_acud}%")
                    ->orWhere('nomb_acud', 'LIKE', "%{$sear_acud}%")
                    ->orWhere('pape_acud', 'LIKE', "%{$sear_acud}%")
                    ->orWhere('sape_acud', 'LIKE', "%{$sear_acud}%");
    }

    /**
     * Scope usuario autenticado
     * @param collection $query
     * @return collection
     */
    public function scopeAutenticado($query)
    {
        if (Shinobi::isRole(SpecialRole::acudiente()))
        {
            return $query->where('id', acudiente('id'));
        }
    }

}
