<?php

namespace App\Facades;

class Cargo
{
    /**
     * Constantes
     *
     * @var constantes
     */
    const ADMINISTRADOR = '0';
    const COORDINADOR = '1';
    const SECRETARIA = '2';

    /**
     * Devuelve el cargo administrador.
     *
     * @return string
     */
    public function administrador()
    {
    	return self::ADMINISTRADOR;
    }

    /**
     * Devuelve el cargo coordinador.
     *
     * @return string
     */
    public function coordinador()
    {
    	return self::COORDINADOR;
    }

    /**
     * Devuelve el cargo secretaria.
     *
     * @return string
     */
    public function secretaria()
    {
        return self::SECRETARIA;
    }

    /**
     * Devuelve los valores de los cargos.
     *
     * @return array
     */
    public function indexados()
    {
    	return [
    		self::ADMINISTRADOR, self::COORDINADOR, self::SECRETARIA,
    	];
    }

    /**
     * Devuelve los valores de los cargos con su etiqueta.
     *
     * @return array
     */
    public function asociativos()
    {
    	return [
    		['id' => self::ADMINISTRADOR, 'texto' => 'Administrador'],
            ['id' => self::COORDINADOR, 'texto' => 'Coordinador'],
            ['id' => self::SECRETARIA, 'texto' => 'Secretaria'],
    	];
    }

    /**
     * Devuelve el nombre del primer cargo encontrado.
     *
     * @return array
     */
    public function find($value)
    {
        $cargos = $this->asociativos();

        return array_first($cargos, function ($cargo) use ($value) {
            return $cargo['id'] === (string) $value;
        });
    }

}
