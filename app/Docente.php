<?php

namespace App;

use App\Events\UsuarioRegistrado;
use App\Scopes\DocenteScope;
use App\Traits\Uuids;
use Caffeinated\Shinobi\Facades\Shinobi;
use Facades\App\Facades\Estado;
use Facades\App\Facades\Sexo;
use Facades\App\Facades\SpecialRole;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
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

        static::addGlobalScope(new DocenteScope);
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
        'docu_doce', 'nomb_doce', 'pape_doce', 'sape_doce', 'sexo_doce', 'dire_doce',
        'barr_doce', 'corr_doce', 'tele_doce', 'titu_doce', 'espe_doce', 'expe_doce',
        'obse_doce', 'empleado_id', 'user_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'sexo_doce' => 'string',
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
     * Docente tiene un empleado.
     *
     * @return Model
     */
    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    /**
     * Docente tiene un usuario.
     *
     * @return Model
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Docentes tienen muchas asignaturas.
     *
     * @return Model
     */
    public function asignaturas()
    {
        return $this->hasMany(Asignatura::class);
    }

    /**
     * Docentes tienen muchas mesas de ayuda.
     *
     * @return Model
     */
    public function mesas()
    {
        return $this->hasMany(Mesa::class);
    }

    /**
     * Docentes tienen muchas planeamientos.
     *
     * @return Model
     */
    public function planeamientos()
    {
        return $this->hasMany(Planeamiento::class);
    }

    /**
     * Docentes tienen muchos subgrados.
     *
     * @return Model
     */
    public function subGrados()
    {
        return $this->belongsToMany(SubGrado::class);
    }

    /**
     * Docentes tienen muchos practicantes.
     *
     * @return Model
     */
    public function practicantes()
    {
        return $this->belongsToMany(Practicante::class)
                    ->withPivot('id', 'fech_segu', 'hora_lleg', 'hora_sali', 'acti_real', 'hora_cump', 'obse_segu')
                    ->orderBy('fech_segu')
                    ->orderByDesc('created_at');
    }

    /*
    |----------------------------------------------------------------------
    | Métodos
    |----------------------------------------------------------------------
    |
    */

    /**
     * Devuelve los docentes disponibles
     * @return collection
     */
    public static function queryDocentes()
    {
        $docentes = Docente::query()
                            ->withoutGlobalScopes()
                            ->select('id', 'nomb_doce', 'pape_doce', 'sape_doce')
                            ->whereHas('user', function ($query) {
                                return $query->where('estado', Estado::activo());
                            })
                            ->orderBy('nomb_doce')
                            ->orderBy('pape_doce');

        if (! Shinobi::isRole(SpecialRole::administrador()))
        {
            $usuario = auth()->user()->load('docente');

            if (! is_null($usuario->docente))
            {
                $docentes->where('id', $usuario->docente->id);
            }
        }

        return $docentes->get();
    }

    /**
     * Devuelve el nombre del sexo
     *
     * @return string
     */
    public function getSexo()
    {
        return optional(Sexo::find($this->sexo_doce))['texto'];
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
     * @param integer $docu_doce
     * @return collection
     */
    public function scopeDocumento($query, $docu_doce)
    {
        if (isset($docu_doce))
        {
            return $query->where('docu_doce', 'LIKE', "%{$docu_doce}%");
        }
    }

    /**
     * Scope nombre
     * @param collection $query
     * @param string $nomb_doce
     * @return collection
     */
    public function scopeNombre($query, $nomb_doce)
    {
        if (isset($nomb_doce))
        {
            return $query->where('nomb_doce', 'LIKE', "%{$nomb_doce}%");
        }
    }

    /**
     * Scope primer apellido
     * @param collection $query
     * @param string $pape_doce
     * @return collection
     */
    public function scopePrimerApellido($query, $pape_doce)
    {
        if (isset($pape_doce))
        {
            return $query->where('pape_doce', 'LIKE', "%{$pape_doce}%");
        }
    }

    /**
     * Scope segundo apellido
     * @param collection $query
     * @param string $sape_doce
     * @return collection
     */
    public function scopeSegundoApellido($query, $sape_doce)
    {
        if (isset($sape_doce))
        {
            return $query->where('sape_doce', 'LIKE', "%{$sape_doce}%");
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
                return $query->where('id', $usuario->docente->id);
            }
        }
    }

}
