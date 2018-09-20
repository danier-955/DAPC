<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Guarda la imagen en el disco y devuele el nombre.
     *
     * @param  input $file
     * @param  string $disk
     * @return string
     */
    protected function storePhoto($file, $disk)
    {
        if ($disk === 'evento')
        {
            $photo = str_random(40) . '.' . $file->extension();

            $path = Storage::disk($disk)->getDriver()->getAdapter()->getPathPrefix();
        }
        else
        {
            $photo = $file->store('', $disk);

            $path = Storage::disk($disk . '.thumbnail')->getDriver()->getAdapter()->getPathPrefix();
        }

        /**
         * Reducir imagen
         */
        Image::make($file)->resize(480, null, function ($constraint)
        {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save($path . $photo, 95);

        return $photo;
    }

    /**
     * Elimina la imagen del disco
     *
     * @param  string $file
     * @param  string $disk
     * @return void
     */
    protected function deletePhoto($file, $disk)
    {
        try
        {
            if (Storage::disk($disk)->exists($file))
            {
                Storage::disk($disk)->delete($file);
            }

            if ($disk !== 'evento')
            {
                if (Storage::disk($disk . '.thumbnail')->exists($file))
                {
                    Storage::disk($disk . '.thumbnail')->delete($file);
                }
            }
        }
        catch (\Exception $e) { }
    }

}
