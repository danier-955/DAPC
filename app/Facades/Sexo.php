<?php

namespace App\Facades;

class Sexo
{
    /**
     * Constantes
     *
     * @var constantes
     */
    const FEMENINO = '0';
    const MASCULINO = '1';

    /**
     * Devuelve el sexo femenino.
     *
     * @return string
     */
    public function femenino()
    {
    	return self::FEMENINO;
    }

    /**
     * Devuelve el sexo masculino.
     *
     * @return string
     */
    public function masculino()
    {
    	return self::MASCULINO;
    }

    /**
     * Devuelve los valores de los sexos.
     *
     * @return array
     */
    public function indexados()
    {
    	return [
    		self::FEMENINO, self::MASCULINO,
    	];
    }

    /**
     * Devuelve los valores de los sexos con su etiqueta.
     *
     * @return array
     */
    public function asociativos()
    {
    	return [
    		[ 'id' => self::FEMENINO, 'texto' => 'Femenino' ],
    		[ 'id' => self::MASCULINO, 'texto' => 'Masculino' ],
    	];
    }

    /**
     * Devuelve el nombre del primer sexo encontrado.
     *
     * @return array
     */
    public function find($value)
    {
        $sexos = $this->asociativos();

        return array_first($sexos, function ($sexo) use ($value) {
            return $sexo['id'] === (string) $value;
        });
    }

}
