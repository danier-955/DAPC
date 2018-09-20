<?php

namespace App\Observers;

use App\Bitacora;
use Facades\App\Facades\Operacion;
use Illuminate\Database\Eloquent\Model;

class ModelObserver
{
    /**
     * Listen to the Model created event.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function created(Model $model)
    {
        Bitacora::guardar(Operacion::registrado(), $model);
    }

    /**
     * Listen to the Model updated event.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function updated(Model $model)
    {
        Bitacora::guardar(Operacion::actualizado(), $model);
    }

    /**
     * Listen to the Model deleted event.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function deleted(Model $model)
    {
        Bitacora::guardar(Operacion::eliminado(), $model);
    }
}