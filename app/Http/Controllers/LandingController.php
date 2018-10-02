<?php

namespace App\Http\Controllers;

use App\Evento;
use App\Galeria;
use App\Programa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LandingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application landing page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * Galerias
         */
        $takeGalerias = config('app.landing.galeria');
        $galerias = array();

        $galleries = Galeria::query()
                            ->mostrada(true)
                            ->orderByDesc('updated_at')
                            ->orderBy('titu_gale')
                            ->cursor();

        foreach ($galleries as $gallery)
        {
           if (Storage::disk('galeria')->exists($gallery->foto_gale))
           {
                $galerias[] = $gallery;
           }
        }

        $galerias = collect($galerias)->take($takeGalerias);

        // $galerias = $galerias->filter(function ($galeria)
        // {
        //     return Storage::disk('galeria')->exists($galeria->foto_gale);
        // })->take($takeGalerias);

        /**
         * Eventos
         */
        $takeEventos = config('app.landing.evento');
        $now = now();

        $eventos = Evento::query()
                        ->mostrada(true)
                        ->where('inic_even', '<=', $now)
                        ->where('fina_even', '>=', $now)
                        ->orderByDesc('updated_at')
                        ->orderBy('titu_even')
                        ->take($takeEventos)
                        ->get();

        /**
         * Programas
         */
        $takeProgramas = config('app.landing.programa');

        $programas = Programa::query()
                            ->orderByDesc('updated_at')
                            ->orderBy('nomb_prog')
                            ->take($takeProgramas)
                            ->get();

        return view('landing.index', compact('galerias', 'eventos', 'programas'));
    }

    /**
     * Display a listing of the eventos.
     *
     * @return \Illuminate\Http\Response
     */
    public function eventos()
    {
        $now = now();

        $eventos = Evento::query()
                        ->mostrada(true)
                        ->where('inic_even', '<=', $now)
                        ->where('fina_even', '>=', $now)
                        ->orderByDesc('inic_even')
                        ->orderByDesc('fina_even')
                        ->orderBy('titu_even')
                        ->paginate();

        return view('landing.eventos.index', compact('eventos'));
    }

}
