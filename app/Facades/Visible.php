<?php

namespace App\Facades;

class Visible
{
    /**
     * Constantes
     *
     * @var constantes
     */
    const NO_VISIBLE = '0';
    const VISIBLE = '1';

    /**
     * Devuelve el estado visible.
     *
     * @return string
     */
    public function visible()
    {
    	return self::VISIBLE;
    }

    /**
     * Devuelve el estado noVisible.
     *
     * @return string
     */
    public function noVisible()
    {
    	return self::NO_VISIBLE;
    }

    /**
     * Devuelve los valores de los estados de la galeria con su etiqueta.
     *
     * @return array
     */
    public function asociativos()
    {
    	return [
    		['id' => $this->visible(), 'texto' => 'Visible'],
            ['id' => $this->noVisible(), 'texto' => 'Oculto'],
    	];
    }

    /**
     * Devuelve el nombre del primer estado encontrado.
     *
     * @return array
     */
    public function find($value)
    {
        $estados = $this->asociativos();

        return array_first($estados, function ($estado) use ($value) {
            return $estado['id'] === (string) $value;
        });
    }

    /**
     * Devuelve el color del estado.
     *
     * @return array
     */
    public function getColor($value)
    {
        return ($this->visible() === $value) ? 'bg-success text-white' : 'bg-danger text-white';
    }

}
