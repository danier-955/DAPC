<?php

namespace App\Http\Controllers;

use App\Bitacora;
use Illuminate\Http\Request;
use Facades\App\Facades\Estado;
use App\Http\Requests\BusquedaRequest;

class BitacoraController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('has.permission:bitacoras.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BusquedaRequest $request)
    {
        $request->validate();

        $bitacoras = Bitacora::query()
                            ->with('user')
                            ->fecha($request->fech_inic, $request->fech_fina)
                            ->operacion($request->oper_bita)
                            // ->responsable($request->usua_bita)
                            ->orderByDesc('created_at')
                            ->paginate();

        return view('bitacoras.index', compact('bitacoras', 'usuarios'));
    }

}
