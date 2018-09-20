<?php

namespace App\Facades;

class TipoNota
{
    /**
     * Constantes
     *
     * @var constantes
     */
    const REGULAR = '0';
    const RECUPERACION = '1';

    /**
     * Devuelve el tipo de nota regular.
     *
     * @return string
     */
    public function regular()
    {
    	return self::REGULAR;
    }

    /**
     * Devuelve el tipo de nota recuperación.
     *
     * @return string
     */
    public function recuperacion()
    {
    	return self::RECUPERACION;
    }

    /**
     * Devuelve los valores de los tipos de nota.
     *
     * @return array
     */
    public function indexados()
    {
    	return [
    		self::REGULAR, self::RECUPERACION,
    	];
    }

    /**
     * Devuelve los valores de los tipos de nota con su etiqueta.
     *
     * @return array
     */
    public function asociativos()
    {
    	return [
    		['id' => self::REGULAR, 'texto' => 'Regular'],
            ['id' => self::RECUPERACION, 'texto' => 'Recuperación'],
    	];
    }

    /**
     * Devuelve el nombre del primer tipo de nota encontrado.
     *
     * @return array
     */
    public function find($value)
    {
        $tipoNotas = $this->asociativos();

        return array_first($tipoNotas, function ($tipoNota) use ($value) {
            return $tipoNota['id'] === (string) $value;
        });
    }

}
