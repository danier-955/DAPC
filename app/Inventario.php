<?php

namespace App;

use App\Scopes\InventarioScope;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use Uuids;

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new InventarioScope);
    }

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
        'stoc_inve', 'administrativo_id', 'implemento_id',
    ];

    /*
    |----------------------------------------------------------------------
    | Relaciones
    |----------------------------------------------------------------------
    |
    */

    /**
     * Inventario tiene un administrativo.
     *
     * @return Model
     */
    public function administrativo()
    {
        return $this->belongsTo(Administrativo::class);
    }

    /**
     * Inventario tiene un implemento.
     *
     * @return Model
     */
    public function implemento()
    {
        return $this->belongsTo(Implemento::class);
    }

    /**
     * Inventarios tienen muchas mesas.
     *
     * @return Model
     */
    public function mesas()
    {
        return $this->belongsToMany(Mesa::class)->withPivot('cant_desc', 'esta_desc');
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

}
