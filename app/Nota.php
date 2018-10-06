<?php

namespace App;

use App\Traits\Uuids;
use Caffeinated\Shinobi\Facades\Shinobi;
use Facades\App\Facades\Escala;
use Facades\App\Facades\Estado;
use Facades\App\Facades\SpecialRole;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
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
        'codi_nota', 'nota_per1', 'nota_per2', 'nota_per3', 'nota_per4', 'nota_def1',
        'nota_def2', 'nota_def3', 'nota_def4', 'cali_per1', 'cali_per2', 'cali_per3',
        'cali_per4', 'nota_rec1', 'nota_rec2', 'nota_rec3', 'nota_rec4', 'cali_rec1',
        'cali_rec2', 'cali_rec3', 'cali_rec4', 'ano_nota', 'asignatura_id', 'estudiante_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'nota_per1' => 'real',
        'nota_per2' => 'real',
        'nota_per3' => 'real',
        'nota_per4' => 'real',
        'nota_rec1' => 'real',
        'nota_rec2' => 'real',
        'nota_rec3' => 'real',
        'nota_rec4' => 'real',
        'nota_def1' => 'real',
        'nota_def2' => 'real',
        'nota_def3' => 'real',
        'nota_def4' => 'real',
        'nota_defi' => 'real',
        'cali_per1' => 'boolean',
        'cali_per2' => 'boolean',
        'cali_per3' => 'boolean',
        'cali_per4' => 'boolean',
        'cali_rec1' => 'boolean',
        'cali_rec2' => 'boolean',
        'cali_rec3' => 'boolean',
        'cali_rec4' => 'boolean',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'nota_defi'
    ];

    /*
    |----------------------------------------------------------------------
    | Accesores
    |----------------------------------------------------------------------
    |
    */

    /**
     * Obtiene el valor de la definitiva.
     *
     * @return void
     */
    public function getNotaDefiAttribute()
    {
        if ($this->cali_per1 and !$this->cali_per2 and !$this->cali_per3 and !$this->cali_per4)
        {
            $nota_defi = $this->nota_def1;
        }
        elseif ($this->cali_per1 and $this->cali_per2 and !$this->cali_per3 and !$this->cali_per4)
        {
            $nota_defi = $this->nota_def2;
        }
        elseif ($this->cali_per1 and $this->cali_per2 and $this->cali_per3 and !$this->cali_per4)
        {
            $nota_defi = $this->nota_def3;
        }
        else {
            $nota_defi = $this->nota_def4;
        }

        return $this->attributes['nota_defi'] = $nota_defi;
    }

    /*
    |----------------------------------------------------------------------
    | Relaciones
    |----------------------------------------------------------------------
    |
    */

    /**
     * Nota tiene una asignatura.
     *
     * @return Model
     */
    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class);
    }

    /**
     * Nota tiene un estudiante.
     *
     * @return Model
     */
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }

    /*
    |----------------------------------------------------------------------
    | Métodos
    |----------------------------------------------------------------------
    |
    */

    /**
     * Devuelve el nombre del estudiante
     *
     * @return string
     */
    public function getEstudiante()
    {
        return (! is_null($this->estudiante)) ? "{$this->estudiante->nomb_estu} {$this->estudiante->pape_estu} {$this->estudiante->sape_estu}" : '';
    }

    /**
     * Devuelve el nombre de la asignatura
     *
     * @return string
     */
    public function getAsignatura()
    {
        return (! is_null($this->asignatura)) ? $this->asignatura->nomb_asig : '';
    }

    /**
     * Devuelve el color de la nota
     *
     * @param string $campo
     * @return string
     */
    public function getNotaColor($campo)
    {
        return ($this->{$campo} >= Escala::basico()['min']) ? 'bg-success text-white' : 'bg-danger text-white';
    }

    /**
     * Devuelve el valor de la nota de recuperación
     *
     * @param string $campo
     * @return string
     */
    public function getNotaRecuperacion($campo)
    {
        return ($this->{$campo} > Escala::bajo()['min']) ? "data-toggle=\"tooltip\" title=\"Nota recuperación: {$this->nota_rec1}\"" : '';
    }

    /**
     * Devuelve la escala completa de la nota
     *
     * @return string
     */
    public function getEscalaCompleta()
    {
        return Escala::find($this->nota_defi, false);
    }

    /**
     * Devuelve la escala corta de la nota
     *
     * @return string
     */
    public function getEscalaCorta()
    {
        return Escala::find($this->nota_defi, true);
    }

    /*
    |----------------------------------------------------------------------
    | Scopes
    |----------------------------------------------------------------------
    |
    */

    /**
     * Scope usuario autenticado
     * @param collection $query
     * @return collection
     */
    public function scopeAutenticado($query)
    {
        if (Shinobi::isRole(SpecialRole::estudiante()))
        {
            return $query->whereHas('estudiante', function ($queryE)
                        {
                            $queryE->whereHas('user', function ($queryU)
                                {
                                    $queryU->where('estado', Estado::activo());
                                })
                                ->where('id', estudiante('id'));
                        });
        }
        elseif (Shinobi::isRole(SpecialRole::acudiente()))
        {
            return $query->whereHas('estudiante', function ($queryE)
                        {
                            $queryE->whereHas('user', function ($queryU)
                                {
                                    $queryU->where('estado', Estado::activo());
                                })
                                ->where('acudiente_id', acudiente('id'));
                        });
        }
        else
        {
            return $query->whereHas('estudiante', function ($queryE)
                        {
                            $queryE->whereHas('user', function ($queryU)
                                {
                                    $queryU->where('estado', Estado::activo());
                                });
                        });
        }
    }
}
