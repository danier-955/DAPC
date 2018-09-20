<?php

namespace App\Facades;

class TipoNomina
{
    /**
     * Constantes
     *
     * @var constantes
     */
    const MENSUAL = '0';
    const QUINCENAL = '1';
    const UNICO = '2';
    const QUINCENA_1 = '1';
    const QUINCENA_2 = '2';

    /**
     * Devuelve el tipo de pago de nomina mensual.
     *
     * @return string
     */
    public function mensual()
    {
    	return self::MENSUAL;
    }

    /**
     * Devuelve el tipo de pago de nomina quincenal.
     *
     * @return string
     */
    public function quincenal()
    {
    	return self::QUINCENAL;
    }

    /**
     * Devuelve el tipo de pago de nomina unico.
     *
     * @return string
     */
    public function unico()
    {
        return self::UNICO;
    }

    /**
     * Devuelve la primera quincena.
     *
     * @return string
     */
    public function primeraQuincena()
    {
        return self::QUINCENA_1;
    }

    /**
     * Devuelve la segunda quincena.
     *
     * @return string
     */
    public function segundaQuincena()
    {
        return self::QUINCENA_2;
    }

    /**
     * Devuelve los valores de los tipos de pago de  nominas.
     *
     * @return array
     */
    public function indexados()
    {
    	return [
    		self::MENSUAL, self::QUINCENAL, self::UNICO,
    	];
    }

    /**
     * Devuelve los valores de los tipos de pago de  nominas con su etiqueta.
     *
     * @return array
     */
    public function asociativos()
    {
    	return [
    		['id' => self::MENSUAL, 'texto' => 'Mensual'],
            ['id' => self::QUINCENAL, 'texto' => 'Quincenal'],
            ['id' => self::UNICO, 'texto' => 'Único'],
    	];
    }

    /**
     * Devuelve los valores de las quincenas.
     *
     * @return array
     */
    public function quincenaIndexados()
    {
        return [
            self::QUINCENA_1, self::QUINCENA_2,
        ];
    }

    /**
     * Devuelve los valores de las quincenas con su etiqueta.
     *
     * @return array
     */
    public function quincenaAsociativos()
    {
        return [
            ['id' => self::QUINCENA_1, 'texto' => 'Primera'],
            ['id' => self::QUINCENA_2, 'texto' => 'Segunda'],
        ];
    }

    /**
     * Devuelve el nombre del primer tipo de nomina encontrado.
     *
     * @return array
     */
    public function find($value)
    {
        $tipoNominas = $this->asociativos();

        return array_first($tipoNominas, function ($tipoNomina) use ($value) {
            return $tipoNomina['id'] === (string) $value;
        });
    }

    /**
     * Devuelve el nombre de la primera quincena encontrada.
     *
     * @return array
     */
    public function findQuincena($value)
    {
        $quincenas = $this->quincenaAsociativos();

        return array_first($quincenas, function ($quincena) use ($value) {
            return $quincena['id'] === (string) $value;
        });
    }

}
