<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    use Uuids;

    /**
     * Global scope
     * @return void
     */
    /*protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ImplementoScope);
    }*/

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
        'nomb_prog', 'desc_prog',
    ];

        /*
    |----------------------------------------------------------------------
    | Relaciones
    |----------------------------------------------------------------------
    |
    */

      /**
     * Evento tiene un administrativo.
     *
     * @return Model
     */
    public function administrativo()
    {
        return $this->belongsTo(Administrativo::class);
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
     * Scope nombre util
     * @param collection $query
     * @param string $nomb_prog
     * @return collection
     */
    public function scopePrograma($query, $nomb_prog)
    {
        if (isset($nomb_prog))
        {
            return $query->where('nomb_prog', 'LIKE', "%{$nomb_prog}%");
        }
    }


}
