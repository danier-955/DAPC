<?php

namespace App;

use App\Events\UsuarioRegistrado;
use App\Scopes\EstudianteScope;
use App\Traits\Uuids;
use Carbon\Carbon;
use Facades\App\Facades\Sexo;
use Facades\App\Facades\Parentesco;
use Facades\App\Facades\Estado;
use Facades\App\Facades\SpecialRole;
use Facades\App\Facades\TipoEstudiante;
use Illuminate\Database\Eloquent\Model;
use Caffeinated\Shinobi\Facades\Shinobi;

class Estudiante extends Model
{
    use Uuids;

    /**
     * Global scope
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new EstudianteScope);
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
        'tipo_docu', 'docu_estu', 'nomb_estu', 'pape_estu', 'sape_estu', 'sexo_estu',
        'fech_naci', 'dire_estu', 'barr_estu', 'corr_estu', 'tele_estu', 'padr_estu',
        'madr_estu', 'pare_acud', 'cole_prov', 'eps_estu', 'copi_docu', 'copi_grad',
        'tipo_estu', 'carn_vacu', 'foto_estu', 'fech_reti', 'fech_grad', 'obse_estu',
        'acudiente_id', 'sub_grado_id', 'user_id',
    ];

    /**
     * The attributes dates.
     *
     * @var array
     */
    protected $dates = [
        'fech_naci', 'fech_reti', 'fech_grad',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'sexo_estu' => 'string',
        'tipo_estu' => 'string',
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
     * Estudiante tiene un usuario.
     *
     * @return Model
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Estudiante tiene un subGrado.
     *
     * @return Model
     */
    public function subGrado()
    {
        return $this->belongsTo(SubGrado::class);
    }

    /**
     * Estudiante tiene un acudiente.
     *
     * @return Model
     */
    public function acudiente()
    {
        return $this->belongsTo(Acudiente::class);
    }

    /**
     * Estudiantes tienen muchos implementos.
     *
     * @return Model
     */
    public function implementos()
    {
        return $this->belongsToMany(Implemento::class)->withPivot('cant_util');
    }

    /**
     * Estudiantes tienen muchas nominas.
     *
     * @return Model
     */
    public function nominas()
    {
        return $this->belongsToMany(Nomina::class);
    }

    /**
     * Estudiantes tienen muchas asistencias.
     *
     * @return Model
     */
    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }

    /**
     * Estudiantes tienen muchas notas.
     *
     * @return Model
     */
    public function notas()
    {
        return $this->hasMany(Nota::class);
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
        return optional(Sexo::find($this->sexo_estu))['texto'];
    }

    /**
     * Devuelve el tipo de estudiante
     *
     * @return string
     */
    public function getTipoEstudiante()
    {
        return optional(TipoEstudiante::find($this->tipo_estu))['texto'];
    }

    /**
     * Devuelve el tipo de estudiante
     *
     * @return string
     */
    public function getParentesco()
    {
        return optional(Parentesco::find($this->pare_acud))['texto'];
    }

    /**
     * Devuelve el nombre del acudiente
     *
     * @return string
     */
    public function getAcudiente()
    {
        if (!is_null($this->acudiente))
        {
            return "{$this->acudiente->nomb_acud} {$this->acudiente->pape_acud} {$this->acudiente->sape_acud}";
        }
    }

    /**
     * Devuelve el id del subGrado
     *
     * @return string
     */
    public function getSubGradoId()
    {
        if (!is_null($this->subGrado))
        {
            return $this->subGrado->id;
        }
    }

    /**
     * Devuelve el nombre del subGrado
     *
     * @return string
     */
    public function getSubGradoNombre()
    {
        if (!is_null($this->subGrado) && !is_null($this->subGrado->grado))
        {
            $grado = $this->subGrado->grado;

            return $grado->abre_grad . ' &middot; ' . $this->subGrado->abre_subg . ' &middot; Jornada '. $grado->getJornada();
        }

    }

    /**
     * Devuelve los estudiantes disponibles
     * @return collection
     */
    public static function queryEstudiantes()
    {
        $estudiantes = Estudiante::query()
                                ->select('id', 'nomb_estu', 'pape_estu', 'sape_estu')
                                ->whereHas('user', function ($query) {
                                    return $query->where('estado', Estado::activo());
                                })
                                ->orderBy('nomb_estu')
                                ->orderBy('pape_estu');

        if (Shinobi::isRole(SpecialRole::estudiante()))
        {
            $usuario = auth()->user()->load('estudiante');

            if (optional($usuario->estudiante)->exists())
            {
                $estudiantes->where('id', $usuario->estudiante->id);
            }
        }

        return $estudiantes->get();
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
     * @param integer $docu_estu
     * @return collection
     */
    public function scopeDocumento($query, $docu_estu)
    {
        if (isset($docu_estu))
        {
            return $query->where('docu_estu', 'LIKE', "%{$docu_estu}%");
        }
    }

    /**
     * Scope nombre
     * @param collection $query
     * @param string $nomb_estu
     * @return collection
     */
    public function scopeNombre($query, $nomb_estu)
    {
        if (isset($nomb_estu))
        {
            return $query->where('nomb_estu', 'LIKE', "%{$nomb_estu}%");
        }
    }

    /**
     * Scope primer apellido
     * @param collection $query
     * @param string $pape_estu
     * @return collection
     */
    public function scopePrimerApellido($query, $pape_estu)
    {
        if (isset($pape_estu))
        {
            return $query->where('pape_estu', 'LIKE', "%{$pape_estu}%");
        }
    }


    /**
     * Scope sub grado ID
     * @param collection $query
     * @param string $sub_grado_id
     * @return collection
     */
    public function scopeSubgrado($query, $sub_grado_id)
    {
        if (isset($sub_grado_id))
        {
            return $query->where('sub_grado_id', $sub_grado_id);
        }
    }
}
