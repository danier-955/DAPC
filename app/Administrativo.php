<?php

namespace App;

use App\Events\UsuarioRegistrado;
use App\Traits\Uuids;
use Caffeinated\Shinobi\Facades\Shinobi;
use Facades\App\Facades\Cargo;
use Facades\App\Facades\Jornada;
use Facades\App\Facades\Sexo;
use Facades\App\Facades\SpecialRole;
use Illuminate\Database\Eloquent\Model;

class Administrativo extends Model
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
        'docu_admi', 'nomb_admi', 'pape_admi', 'sape_admi', 'sexo_admi', 'dire_admi',
        'barr_admi', 'corr_admi', 'tele_admi', 'titu_admi', 'espe_admi', 'expe_admi',
        'carg_admi', 'jorn_admi', 'obse_admi', 'empleado_id', 'user_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'sexo_admi' => 'string',
        'carg_admi' => 'string',
        'jorn_admi' => 'string',
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
     * Administrativo tiene un empleado.
     *
     * @return Model
     */
    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    /**
     * Administrativo tiene un usuario.
     *
     * @return Model
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Administrativos tienen muchos eventos.
     *
     * @return Model
     */
    public function eventos()
    {
        return $this->hasMany(Evento::class);
    }

    /**
     * Administrativos tienen muchos calendarios.
     *
     * @return Model
     */
    public function calendarios()
    {
        return $this->hasMany(Calendario::class);
    }

    /**
     * Administrativos tienen muchas galerias.
     *
     * @return Model
     */
    public function galerias()
    {
        return $this->hasMany(Galeria::class);
    }

    /**
     * Administrativos tienen muchos inventarios.
     *
     * @return Model
     */
    public function inventarios()
    {
        return $this->hasMany(Inventario::class);
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
        return optional(Sexo::find($this->sexo_admi))['texto'];
    }

    /**
     * Devuelve el nombre del cargo
     *
     * @return string
     */
    public function getCargo()
    {
        return optional(Cargo::find($this->carg_admi))['texto'];
    }

    /**
     * Devuelve el nombre de la jornada
     *
     * @return string
     */
    public function getJornada()
    {
        return optional(Jornada::find($this->jorn_admi))['texto'];
    }

    /**
     * Verifica que se pueda cambiar la jornada.
     *
     * @return bool
     */
    public function puedeCambiarCargoJornada()
    {
        return Shinobi::isRole(SpecialRole::administrador()) && $this->id !== administrativo('id');
    }

    /**
     * Verifica que no se pueda cambiar la jornada.
     *
     * @return bool
     */
    public function noPuedeCambiarCargoJornada()
    {
        return ! $this->puedeCambiarCargoJornada();
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
     * @param integer $docu_admi
     * @return collection
     */
    public function scopeDocumento($query, $docu_admi)
    {
        if (isset($docu_admi))
        {
            return $query->where('docu_admi', 'LIKE', "%{$docu_admi}%");
        }
    }

    /**
     * Scope nombre
     * @param collection $query
     * @param string $nomb_admi
     * @return collection
     */
    public function scopeNombre($query, $nomb_admi)
    {
        if (isset($nomb_admi))
        {
            return $query->where('nomb_admi', 'LIKE', "%{$nomb_admi}%");
        }
    }

    /**
     * Scope primer apellido
     * @param collection $query
     * @param string $pape_admi
     * @return collection
     */
    public function scopePrimerApellido($query, $pape_admi)
    {
        if (isset($pape_admi))
        {
            return $query->where('pape_admi', 'LIKE', "%{$pape_admi}%");
        }
    }

    /**
     * Scope cargo
     * @param collection $query
     * @param string $carg_admi
     * @return collection
     */
    public function scopeCargo($query, $carg_admi)
    {
        if (isset($carg_admi))
        {
            return $query->where('carg_admi', $carg_admi);
        }
    }

    /**
     * Scope usuario autenticado
     * @param collection $query
     * @return collection
     */
    public function scopeAutenticado($query)
    {
        if (auth()->user()->esAdministrativo() && !Shinobi::isRole(SpecialRole::administrador()))
        {
            return $query->where('id', administrativo('id'));
        }
    }

}
