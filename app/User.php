<?php

namespace App;

use App\Notifications\MyResetPassword;
use App\Scopes\UserScope;
use App\Traits\Uuids;
use Caffeinated\Shinobi\Facades\Shinobi;
use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Facades\App\Facades\Estado;
use Facades\App\Facades\SpecialRole;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, Uuids, ShinobiTrait;

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    /*protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new UserScope);
    }*/

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
        'nombre', 'email', 'password', 'estado'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'estado' => 'string',
    ];

    /*
    |----------------------------------------------------------------------
    | Relaciones
    |----------------------------------------------------------------------
    |
    */

    /**
     * Users tienen muchas bitacoras.
     *
     * @return Model
     */
    public function bitacoras()
    {
        return $this->hasMany(Bitacora::class);
    }

    /**
     * User tiene un acudiente.
     *
     * @return Model
     */
    public function acudiente()
    {
        return $this->hasOne(Acudiente::class);
    }

    /**
     * User tiene un estudiante.
     *
     * @return Model
     */
    public function estudiante()
    {
        return $this->hasOne(Estudiante::class);
    }

    /**
     * User tiene un administrativo.
     *
     * @return Model
     */
    public function administrativo()
    {
        return $this->hasOne(Administrativo::class);
    }

    /**
     * User tiene un docente.
     *
     * @return Model
     */
    public function docente()
    {
        return $this->hasOne(Docente::class);
    }

    /**
     * Users tienen muchos permisos
     *
     * @return Model
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }

    /**
     * Users tienen muchos roles.
     *
     * @return Model
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    /*
    |----------------------------------------------------------------------
    | Métodos
    |----------------------------------------------------------------------
    |
    */

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MyResetPassword($token));
    }

    /**
     * Devuelve el nombre del estado
     *
     * @return string
     */
    public function getEstadoNombre()
    {
        return optional(Estado::find($this->estado))['texto'];
    }

    /**
     * Devuelve el color del estado
     *
     * @return string
     */
    public function getEstadoColor()
    {
        return Estado::getColor($this->estado);
    }

    /**
     * Devuelve el nombre del rol
     *
     * @return string
     */
    public function getRolNombre()
    {
        if (! is_null($this->roles))
        {
            return $this->roles->first()->name;
        }
    }

    /**
     * Devuelve el slug del rol
     *
     * @return string
     */
    public function getRolSlug()
    {
        if (! is_null($this->roles))
        {
            return $this->roles->first()->slug;
        }
    }

    /**
     * Devuelve el id del rol
     *
     * @return string
     */
    public function getRolId()
    {
        if (! is_null($this->roles))
        {
           return $this->roles->first()->id;
        }
    }

    /**
     * Verifica que el usuario tenga al menos un rol.
     *
     * @param array $roles
     *
     * @return bool
     */
    public function tieneRoles(array $roles)
    {
        $roles = optional($this->roles)->pluck('slug')->intersect($roles)->count();

        return ($roles > 0) ? true : false;
    }

    /**
     * Verifica que el usuario sea administrativo.
     *
     * @return bool
     */
    public function esAdministrativo()
    {
        return ! $this->tieneRoles([
            SpecialRole::docente(), SpecialRole::estudiante(), SpecialRole::acudiente()
        ]);
    }

    /**
     * Verifica que el usuario sea docente.
     *
     * @return bool
     */
    public function esDocente()
    {
        return $this->tieneRoles([SpecialRole::docente()]);
    }

    /**
     * Verifica que el usuario sea estudiante.
     *
     * @return bool
     */
    public function esEstudiante()
    {
        return $this->tieneRoles([SpecialRole::estudiante()]);
    }

    /**
     * Verifica que el usuario sea acudiente.
     *
     * @return bool
     */
    public function esAcudiente()
    {
        return $this->tieneRoles([SpecialRole::acudiente()]);
    }

    /**
     * Verifica que el usuario pueda cambiar su rol.
     *
     * @return bool
     */
    public function puedeCambiarRol()
    {
        return Shinobi::isRole(SpecialRole::administrador()) && $this->esAdministrativo() && $this->id !== auth()->user()->id;
    }

    /**
     * Verifica que el usuario no tenga permitido actualizar su rol.
     *
     * @return bool
     */
    public function noPuedeCambiarRol()
    {
        return ! $this->puedeCambiarRol();
    }

    /**
     * Verifica que se pueda cambiar el estado del usuario.
     *
     * @param string $estado
     *
     * @return bool
     */
    public function puedeCambiarEstado($estado)
    {
        return ! Shinobi::isRole(SpecialRole::administrador()) && $this->estado !== $estado;
    }

    /**
     * Verifica que un usuario no pueda cambiar directamente su estado.
     *
     * @param string $estado
     *
     * @return bool
     */
    public function noPuedeCambiarSuEstado()
    {
        return $this->id === auth()->user()->id and request()->estado === Estado::inactivo();
    }

    /*
    |----------------------------------------------------------------------
    | Scopes
    |----------------------------------------------------------------------
    |
    */

    /**
     * Scope nombre
     * @param collection $query
     * @param string $nombre
     * @return collection
     */
    public function scopeNombre($query, $nombre)
    {
        if (isset($nombre))
        {
            return $query->where('nombre', 'LIKE', "%{$nombre}%");
        }
    }

    /**
     * Scope estado
     * @param collection $query
     * @param string $estado
     * @return collection
     */
    public function scopeEstado($query, $estado)
    {
        if (isset($estado))
        {
            if ($estado !== Estado::todo())
            {
                return $query->where('estado', $estado);
            }
        }
    }

    /**
     * Scope rol
     * @param collection $query
     * @param string $rol
     * @return collection
     */
    public function scopeRol($query, $rol)
    {
        if (isset($rol))
        {
            return $query->whereHas('roles', function ($query) use ($rol) {
                            return $query->where('id', $rol);
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
        if (! Shinobi::isRole(SpecialRole::administrador()))
        {
            return $query->where('id', auth()->user()->id);
        }
    }

}