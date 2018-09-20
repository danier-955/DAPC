<?php

namespace App\Facades;

class Saldo
{
    /**
     * Constantes
     *
     * @var constantes
     */
    const PENDIENTE = '0';
    const PAGADO = '1';

    /**
     * Devuelve el estado pendiente.
     *
     * @return string
     */
    public function pendiente()
    {
    	return self::PENDIENTE;
    }

    /**
     * Devuelve el estado pagado.
     *
     * @return string
     */
    public function pagado()
    {
        return self::PAGADO;
    }

    /**
     * Devuelve los valores de los estados de los pagos.
     *
     * @return array
     */
    public function indexados()
    {
    	return [
    		self::PENDIENTE, self::PAGADO,
    	];
    }

    /**
     * Devuelve los valores de los estados de los pagos con su etiqueta.
     *
     * @return array
     */
    public function asociativos()
    {
    	return [
    		['id' => self::PENDIENTE, 'texto' => 'Pendiente'],
            ['id' => self::PAGADO, 'texto' => 'Pagado'],
    	];
    }

    /**
     * Devuelve el nombre del primer estado de saldo encontrado.
     *
     * @return array
     */
    public function find($value)
    {
        $saldos = $this->asociativos();

        return array_first($saldos, function ($saldo) use ($value) {
            return $saldo['id'] === (string) $value;
        });
    }

}
