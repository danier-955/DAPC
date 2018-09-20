<?php

namespace App\Traits;

use Webpatser\Uuid\Uuid;

trait Uuids
{
    /**
     * Boot for creating uuid for column id
     * @return Uuid
     */
    protected static function bootUuids()
    {
        /**
         * Listen to the Model creating event.
         *
         * @param  \Illuminate\Database\Eloquent\Model  $model
         * @return void
         */

        static::creating(function ($model)
        {
            if (empty($model->{$model->getKeyName()}))
            {
                $model->{$model->getKeyName()} = Uuid::generate()->string;
            }
        });
    }
}