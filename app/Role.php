<?php

namespace App;

use App\Permission;
use App\Scopes\RoleScope;
use App\Traits\Uuids;
use App\User;
use Caffeinated\Shinobi\Models\Role as ShinobiRole;
use Facades\App\Facades\SpecialRole;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Role extends ShinobiRole
{
    use Uuids;

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    /*protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new RoleScope);
    }*/

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /*
    |----------------------------------------------------------------------
    | Relaciones
    |----------------------------------------------------------------------
    |
    */

    /**
     * Roles can belong to many users.
     *
     * @return Model
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    /**
     * Users and Roles can have many permissions
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class)
                    ->orderBy('slug')
                    ->orderBy('name')
                    ->withTimestamps();
    }

    /*
    |----------------------------------------------------------------------
    | Métodos
    |----------------------------------------------------------------------
    |
    */

    /**
     * Devuelve el nombre del campo special
     *
     * @return string
     */
    public function getSpecialNombre()
    {
        return optional(SpecialRole::find($this->special))['texto'];
    }

    /**
     * Devuelve el color del estado
     *
     * @return string
     */
    public function getSpecialColor()
    {
        return SpecialRole::getColor($this->special);
    }

    /**
     * Devuelve la descripción limitada a unos caracteres
     *
     * @return string
     */
    public function getDescription()
    {
        return Str::limit($this->description, 60);
    }

    /**
     * Devuelve el id del permiso intersectado
     * @param string $permissionId
     * @return string
     */
    public function getPermisssionId($permissionId)
    {
        return head(optional($this->permissions)->pluck('id')->intersect($permissionId)->values()->toArray());
    }

    /**
     * Retorna true si el rol es un rol principal
     *
     * @return boolean
     */
    public function esRolPrincipal()
    {
        return SpecialRole::roles()->contains($this->slug);
    }

    /**
     * Retorna false si el rol no es un rol principal
     *
     * @return boolean
     */
    public function noEsRolPrincipal()
    {
        return ! $this->esRolPrincipal();
    }

    /**
     * Retorna true si tiene Acceso total permitido
     *
     * @return boolean
     */
    public function isAllAccess()
    {
        return $this->special === SpecialRole::allAccess();
    }

    /**
     * Retorna true si tiene Acceso total restringido
     *
     * @return boolean
     */
    public function isNoAccess()
    {
        return $this->special === SpecialRole::noAccess();
    }

    /**
     * Retorna true si tiene Acceso permitido mediante permisos
     *
     * @return boolean
     */
    public function isNullable()
    {
        return $this->special === SpecialRole::nullable();
    }

    /**
     * Habilita el campo special no seleccionado para los roles principales
     *
     * @return boolean
     */
    public function habilitarSpecial($special)
    {
        return $this->esRolPrincipal() && $this->special === $special;
    }

    /**
     * Deshabilita el campo special no seleccionado para los roles principales
     *
     * @return boolean
     */
    public function deshabilitarSpecial($special)
    {
        if ($this->esRolPrincipal())
        {
            if ($this->special === SpecialRole::allAccess())
            {
                if ($this->special !== $special)
                {
                    return true;
                }
            }
            else
            {
                if ($special === SpecialRole::allAccess())
                {
                    return true;
                }
            }

            return false;
        }
        else
        {
            if ($special === SpecialRole::allAccess())
            {
                return true;
            }

            return false;
        }
    }

    /**
     * Verifica que el rol sea administrativo.
     *
     * @return bool
     */
    public function esAdministrativo()
    {
        return $this->slug === SpecialRole::docente() OR $this->slug === SpecialRole::acudiente() OR $this->slug === SpecialRole::estudiante();
    }

    /**
     * Verifica que el rol sea administrador.
     *
     * @return bool
     */
    public function esAdministrador()
    {
        return $this->slug === SpecialRole::administrador();
    }

    /*
    |----------------------------------------------------------------------
    | Scopes
    |----------------------------------------------------------------------
    |
    */

}
