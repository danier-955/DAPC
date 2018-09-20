<?php

namespace App;

use App\Events\UsuarioRegistrado;
use App\Scopes\AcudienteScope;
use App\Traits\Uuids;
use Facades\App\Facades\Sexo;
use Illuminate\Database\Eloquent\Model;

class Acudiente extends Model
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

        static::addGlobalScope(new AcudienteScope);
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

    /*
    |----------------------------------------------------------------------
    | Scopes
    |----------------------------------------------------------------------
    |
    */

}
