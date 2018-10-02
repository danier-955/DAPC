<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Permission;
use App\Role;
use Facades\App\Facades\SpecialRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('has.permission:roles.index')->only(['index']);
        $this->middleware('has.permission:roles.show')->only(['show']);
        $this->middleware('has.permission:roles.create')->only(['create', 'store']);
        $this->middleware('has.permission:roles.edit')->only(['edit', 'update']);
        $this->middleware('has.permission:roles.destroy')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::query()
                    ->orderBy('name')
                    ->paginate();

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::query()
                                ->orderBy('slug')
                                ->orderBy('name')
                                ->get();

        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $request->validate();

        DB::beginTransaction();

        try
        {
            $role = Role::create($request->all());

            if ($request->filled('permissions') && $request->special !== SpecialRole::allAccess())
            {
                $role->syncPermissions($request->get('permissions'));
            }

            DB::commit();

            toast('¡El rol ha sido registrado correctamente!', 'success', 'top-right');

            return redirect()->route('roles.show', $role->id);
        }
        catch (\Symfony\Component\HttpKernel\Exception\HttpException $e)
        {
            DB::rollback();

            toast('¡Se ha producido un error al registrar el rol!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
        catch (\Exception $e)
        {
            DB::rollback();

            toast('¡Se ha producido un error al registrar el rol!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $role->loadMissing('permissions');

        return view('roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        /**
         * Verificar que no se puedan agregar permisos a roles no válidos (que no se pueden relacionar), por ejemplo galerias, eventos, calendarios necesitan de un administrativo_id por tanto es solo para administrativos.
         * --- Tener lo mismo en cuenta para los modulos que tengan "docente_id" y este no se seleccione, revisar cuando todos los modulos esten hechos. ---
         */
        if ($role->noEsAdministrativo())
        {
            $slugs = ['calendarios', 'eventos', 'galerias', 'inventarios', 'programas'];
            $operations = ['create', 'edit', 'destroy'];

            $permissions = Permission::query()
                                    ->orderBy('slug')
                                    ->orderBy('name');

            foreach ($slugs as $slug)
            {
                foreach ($operations as $operation)
                {
                    $permissions->where('slug', '!=', "{$slug}.{$operation}");
                }
            }

            $permissions = $permissions->get();
        }
        else
        {
            $permissions = Permission::query()
                                    ->orderBy('slug')
                                    ->orderBy('name')
                                    ->get();
        }

        $role->loadMissing('permissions');

        return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        $request->validate();

        DB::beginTransaction();

        try
        {
            if ($role->noEsRolPrincipal())
            {
                $role->update($request->all());
            }
            else
            {
                $role->update($request->except('slug'));
            }

            if ($request->filled('permissions') && ! $role->isAllAccess())
            {
                $role->syncPermissions($request->get('permissions'));
            }
            else
            {
                $role->revokeAllPermissions();
            }

            DB::commit();

            toast('¡El rol ha sido actualizado correctamente!', 'success', 'top-right');

            return redirect()->route('roles.show', $role->id);
        }
        catch (\Symfony\Component\HttpKernel\Exception\HttpException $e)
        {
            DB::rollback();

            toast('¡Se ha producido un error al actualizar el rol!', 'error', 'top-right');

            return redirect()->back()->withInput();

        }
        catch (\Exception $e)
        {
            DB::rollback();

            toast('¡Se ha producido un error al actualizar el rol!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        try
        {
            $role->delete();

            toast('¡El rol ha sido eliminado correctamente!', 'success', 'top-right');

            return redirect()->route('roles.index');
        }
        catch (\Exception $e)
        {
            toast('¡Se ha producido un error al eliminar el rol!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }
}
