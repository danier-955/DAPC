<?php

namespace App\Facades;

class Periodo
{
    /**
     * Constantes
     *
     * @var constantes
     */
    const PERIODO_1 = '1';
    const PERIODO_2 = '2';
    const PERIODO_3 = '3';
    const PERIODO_4 = '4';

    /**
     * Devuelve el primer periodo.
     *
     * @return string
     */
    public function primero()
    {
    	return self::PERIODO_1;
    }

    /**
     * Devuelve el segundo periodo.
     *
     * @return string
     */
    public function segundo()
    {
    	return self::PERIODO_2;
    }

    /**
     * Devuelve el tercer periodo.
     *
     * @return string
     */
    public function tercero()
    {
        return self::PERIODO_3;
    }

    /**
     * Devuelve el cuarto periodo.
     *
     * @return string
     */
    public function cuarto()
    {
        return self::PERIODO_4;
    }

    /**
     * Devuelve los valores de los periodos.
     *
     * @return array
     */
    public function indexados()
    {
    	return [
    		self::PERIODO_1, self::PERIODO_2, self::PERIODO_3, self::PERIODO_4,
    	];
    }

    /**
     * Devuelve los valores de los periodos con su etiqueta.
     *
     * @return array
     */
    public function asociativos()
    {
    	return [
    		['id' => self::PERIODO_1, 'texto' => 'Primero'],
            ['id' => self::PERIODO_2, 'texto' => 'Segundo'],
            ['id' => self::PERIODO_3, 'texto' => 'Tercero'],
            ['id' => self::PERIODO_4, 'texto' => 'Cuarto'],
    	];
    }

    /**
     * Devuelve el nombre del primer periodo encontrado.
     *
     * @return array
     */
    public function find($value)
    {
        $periodos = $this->asociativos();

        return array_first($periodos, function ($periodo) use ($value) {
            return $periodo['id'] === (string) $value;
        });
    }

}
