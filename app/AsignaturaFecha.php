<?php

namespace App;

use App\Traits\Uuids;
use Carbon\Carbon;
use Facades\App\Facades\Periodo;
use Facades\App\Facades\TipoNota;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AsignaturaFecha extends Pivot
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
        'fech_nota', 'peri_nota', 'tipo_nota', 'moti_nota', 'asignatura_id', 'fecha_id',
    ];

    /**
     * The attributes dates.
     *
     * @var array
     */
    protected $dates = [
        'fech_nota->fech_inic', 'fech_nota->fech_fina', 'created_at', 'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'fech_nota' => 'array',
        'peri_nota' => 'string',
        'tipo_nota' => 'string',
    ];

    /*
    |----------------------------------------------------------------------
    | Métodos
    |----------------------------------------------------------------------
    |
    */

    /**
     * Get the name of the "updated at" column.
     *
     * @return string
     */
    public function getUpdatedAtColumn()
    {
        if ($this->pivotParent) {
            return $this->pivotParent->getUpdatedAtColumn();
        }

        return static::UPDATED_AT;
    }

    /**
     * Devuelve el nombre del periodo
     *
     * @return string
     */
    public function getPeriodo()
    {
        return optional(Periodo::find($this->peri_nota))['texto'];
    }

    /**
     * Devuelve el nombre del tipo de nota
     *
     * @return string
     */
    public function getTipoNota()
    {
        return optional(TipoNota::find($this->tipo_nota))['texto'];
    }

    /**
     * Devuelve el nombre del estado de la fecha.
     *
     * @return string
     */
    public function getEstadoNombre()
    {
        return $this->esVigente() ? 'Vigente' : 'Inválida';
    }

    /**
     * Devuelve el color del estado de la fecha.
     *
     * @return string
     */
    public function getEstadoColor()
    {
        return $this->esVigente() ? 'bg-success text-white' : 'bg-danger text-white';
    }

    /**
     * Verifica si la fecha esta vigente o vencida.
     *
     * @return boolean
     */
    protected function esVigente()
    {
        try
        {
            $today = now();
            $fech_inic = Carbon::parse($this->fech_nota['fech_inic']);
            $fech_fina = Carbon::parse($this->fech_nota['fech_fina']);

            return ($fech_inic <= $today && $fech_fina >= $today) ? true : false;
        }
        catch (\Exception $e)
        {
            return false;
        }
    }

}
