<?php

namespace App\Listeners;

use App\Acudiente;
use App\Administrativo;
use App\Docente;
use App\Estudiante;
use App\Events\UsuarioRegistrado;
use App\Mail\UsuarioRegistradoMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class EnviarEmailUsuarioRegistrado
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UsuarioRegistrado  $event
     * @return void
     */
    public function handle(UsuarioRegistrado $event)
    {
        if (!is_null($event->model) && $event->model instanceof Acudiente)
        {
            $usuario = [
                'documento' => $event->model->docu_acud,
                'nombre' => "{$event->model->nomb_acud} {$event->model->pape_acud} {$event->model->sape_acud}",
                'correo' => $event->model->corr_acud,
            ];
        }
        elseif (!is_null($event->model) && $event->model instanceof Administrativo)
        {
            $usuario = [
                'documento' => $event->model->docu_admi,
                'nombre' => "{$event->model->nomb_admi} {$event->model->pape_admi} {$event->model->sape_admi}",
                'correo' => $event->model->corr_admi,
            ];
        }
        elseif (!is_null($event->model) && $event->model instanceof Docente)
        {
            $usuario = [
                'documento' => $event->model->docu_doce,
                'nombre' => "{$event->model->nomb_doce} {$event->model->pape_doce} {$event->model->sape_doce}",
                'correo' => $event->model->corr_doce,
            ];
        }
        elseif (!is_null($event->model) && $event->model instanceof Estudiante)
        {
            $usuario = [
                'documento' => $event->model->docu_estu,
                'nombre' => "{$event->model->nomb_estu} {$event->model->pape_estu} {$event->model->sape_estu}",
                'correo' => $event->model->corr_estu,
            ];
        }

        if (! is_null($usuario))
        {
            Mail::to($usuario['correo'])
                ->send(new UsuarioRegistradoMail($usuario));
        }
    }
}
