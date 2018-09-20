<?php

namespace App;

use Carbon\Carbon;
use App\Traits\Uuids;
use Facades\App\Facades\Operacion;
use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
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
        'oper_bita', 'tabl_bita', 'user_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'oper_bita' => 'string',
    ];

    /*
    |----------------------------------------------------------------------
    | Relaciones
    |----------------------------------------------------------------------
    |
    */

    /**
     * Bitacora tiene un usuario.
     *
     * @return Model
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
    |----------------------------------------------------------------------
    | Métodos
    |----------------------------------------------------------------------
    |
    */

    /**
     * Guardar registro en la bitácora
     * @param String $operacion
     * @param Model $modelo
     * @return void
     */
    public static function guardar($operacion, Model $modelo = null)
    {
        try
        {
            if ($modelo instanceof Bitacora || auth()->guest())
            {
                return null;
            }

            if (! is_null($modelo))
            {
                $class_basename = class_basename($modelo);

                if ($class_basename === 'User')
                {
                    $class_basename = 'Usuario';
                }

                $bitacora = new Bitacora;
                $bitacora->oper_bita = $operacion;
                $bitacora->tabl_bita = "{$class_basename}s";

                auth()->user()->bitacoras()->save($bitacora);
            }
        }
        catch(\Exception $e) {

        }
    }

    /**
     * Devuelve el nombre de la operación
     *
     * @return string
     */
    public function getOperacion()
    {
        return optional(Operacion::find($this->oper_bita))['texto'];
    }

    /**
     * Devuelve el nombre del usuario
     *
     * @return string
     */
    public function getUsuario()
    {
        return optional($this->user)->nombre;
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
            $fech_inic = Carbon::parse($fech_inic)->toDateTimeString();
            $fech_fina = Carbon::parse($fech_fina . '23:59:59')->toDateTimeString();

            return $query->whereBetween('created_at', [$fech_inic, $fech_fina]);
        }
    }

    /**
     * Scope tipo
     * @param collection $query
     * @param integer $oper_bita
     * @return collection
     */
    public function scopeOperacion($query, $oper_bita)
    {
        if (isset($oper_bita))
        {
            if ($oper_bita !== Operacion::todo())
            {
                return $query->where('oper_bita', $oper_bita);
            }
        }
    }

    /**
     * Scope responsable
     * @param collection $query
     * @param string $usua_bita
     * @return collection
     */
    public function scopeResponsable($query, $usua_bita)
    {
        if (isset($usua_bita))
        {
            return $query->whereHas('user', function ($user) use ($usua_bita)
            {
                return $user->where('nombre', 'LIKE', "%{$usua_bita}%");
            });
        }
    }


}
