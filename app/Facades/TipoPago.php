<?php

namespace App\Facades;

class TipoPago
{
    /**
     * Constantes
     *
     * @var constantes
     */
    const EGRESO = '0';
    const INGRESO = '1';
    const INVERSION = '2';

    /**
     * Devuelve el tipo de pago egreso.
     *
     * @return string
     */
    public function egreso()
    {
    	return self::EGRESO;
    }

    /**
     * Devuelve el tipo de pago ingreso.
     *
     * @return string
     */
    public function ingreso()
    {
    	return self::INGRESO;
    }

    /**
     * Devuelve el tipo de pago inversion.
     *
     * @return string
     */
    public function inversion()
    {
        return self::INVERSION;
    }


    /**
     * Devuelve los valores de los tipos de pagos.
     *
     * @return array
     */
    public function indexados()
    {
    	return [
    		self::EGRESO, self::INGRESO, self::INVERSION,
    	];
    }

    /**
     * Devuelve los valores de los tipos de pagos con su etiqueta.
     *
     * @return array
     */
    public function asociativos()
    {
    	return [
    		['id' => self::EGRESO, 'texto' => 'Egreso'],
            ['id' => self::INGRESO, 'texto' => 'Ingreso'],
            ['id' => self::INVERSION, 'texto' => 'Inversión'],
    	];
    }

    /**
     * Devuelve el nombre del primer tipo de pago encontrado.
     *
     * @return array
     */
    public function find($value)
    {
        $tipoPagos = $this->asociativos();

        return array_first($tipoPagos, function ($tipoPago) use ($value) {
            return $tipoPago['id'] === (string) $value;
        });
    }

}
