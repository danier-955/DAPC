<?php

namespace App;

use App\Traits\DatesTranslator;
use App\Traits\Uuids;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class Fecha extends Model
{
    use Uuids, DatesTranslator;

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
        'fech_not1', 'fech_not2', 'fech_not3', 'fech_not4', 'fech_rec1', 'fech_rec2',
        'fech_rec3', 'fech_rec4', 'ano_fech',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'fech_not1' => 'array',
        'fech_not2' => 'array',
        'fech_not3' => 'array',
        'fech_not4' => 'array',
        'fech_rec1' => 'array',
        'fech_rec2' => 'array',
        'fech_rec3' => 'array',
        'fech_rec4' => 'array',
    ];

    /*
    |----------------------------------------------------------------------
    | Relaciones
    |----------------------------------------------------------------------
    |
    */

    /**
     * Users tienen muchas asignaturas.
     *
     * @return Model
     */
    public function asignaturas()
    {
        return $this->belongsToMany(Asignatura::class)
                    ->using(AsignaturaFecha::class)
                    ->withPivot('id', 'fech_nota', 'peri_nota', 'moti_nota', 'tipo_nota',
                        'asignatura_id', 'fecha_id')
                    ->orderByDesc('created_at')
                    ->orderBy('tipo_nota')
                    ->orderBy('peri_nota')
                    ->withTimestamps();
    }

    /*
    |----------------------------------------------------------------------
    | Métodos
    |----------------------------------------------------------------------
    |
    */

    /*
    |----------------------------------------------------------------------
    | Scopes
    |----------------------------------------------------------------------
    |
    */

    /**
     * Scope año
     * @param collection $query
     * @param string $year
     * @return collection
     */
    public function scopeYear($query, $year)
    {
        if (isset($year))
        {
            return $query->where('ano_fech', $year);
        }
    }

    /**
     * Scope pivot fecha
     * @param collection $query
     * @param date $fech_inic
     * @param date $fech_fina
     * @return collection
     */
    public function scopePivotFecha($query, $fech_inic, $fech_fina)
    {
        if (isset($fech_inic, $fech_fina))
        {
            $fech_inic = Carbon::parse($fech_inic)->toDateString();
            $fech_fina = Carbon::parse($fech_fina)->toDateString();

            return $query->where(function ($que) use ($fech_inic, $fech_fina)
                    {
                        $que->where('fech_nota->fech_inic', '>=', $fech_inic)
                            ->where('fech_nota->fech_inic', '<=', $fech_fina)
                            ->orWhere(function ($que) use ($fech_inic, $fech_fina)
                            {
                                $que->where('fech_nota->fech_inic', '<=', $fech_inic)
                                    ->where('fech_nota->fech_fina', '>=', $fech_fina);
                            })
                            ->orWhere(function ($que) use ($fech_inic, $fech_fina)
                            {
                                $que->where('fech_nota->fech_fina', '>=', $fech_inic)
                                    ->where('fech_nota->fech_fina', '<=', $fech_fina);
                            });
                    });
        }
    }

    /**
     * Scope pivot periodo
     * @param collection $query
     * @param string $peri_nota
     * @return collection
     */
    public function scopePivotPeriodo($query, $peri_nota)
    {
        if (isset($peri_nota))
        {
            return $query->where(function ($q) use ($peri_nota)
                    {
                        $q->where('peri_nota', $peri_nota);
                    });
        }
    }

    /**
     * Scope pivot tipo de nota
     * @param collection $query
     * @param string $tipo_nota
     * @return collection
     */
    public function scopePivotTipoNota($query, $tipo_nota)
    {
        if (isset($tipo_nota))
        {
            return $query->where(function ($q) use ($tipo_nota)
                    {
                        $q->where('tipo_nota', $tipo_nota);
                    });
        }
    }

}
