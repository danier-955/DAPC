<?php

namespace App\Facades;

class Peticion
{
    /**
     * Constantes
     *
     * @var constantes
     */
    const PENDIENTE = '0';
    const EN_TRAMITE = '1';
    const APROBADO = '2';
    const DENEGADO = '3';

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
     * Devuelve el estado en trámite.
     *
     * @return string
     */
    public function enTramite()
    {
    	return self::EN_TRAMITE;
    }

    /**
     * Devuelve el estado aprobado.
     *
     * @return string
     */
    public function aprobado()
    {
        return self::APROBADO;
    }

    /**
     * Devuelve el estado denegado.
     *
     * @return string
     */
    public function denegado()
    {
        return self::DENEGADO;
    }

    /**
     * Devuelve los valores de los estados de las peticiones.
     *
     * @return array
     */
    public function indexados()
    {
    	return [
    		self::PENDIENTE, self::EN_TRAMITE, self::APROBADO, self::DENEGADO,
    	];
    }

    /**
     * Devuelve los valores de los estados de las peticiones con su etiqueta.
     *
     * @return array
     */
    public function asociativos()
    {
    	return [
    		['id' => self::PENDIENTE, 'texto' => 'Pendiente'],
            ['id' => self::EN_TRAMITE, 'texto' => 'En trámite'],
            ['id' => self::APROBADO, 'texto' => 'Aprobado'],
            ['id' => self::DENEGADO, 'texto' => 'Denegado'],
    	];
    }

    /**
     * Devuelve el nombre del primer estado de peticion encontrado.
     *
     * @return array
     */
    public function find($value)
    {
        $peticiones = $this->asociativos();

        return array_first($peticiones, function ($peticion) use ($value) {
            return $peticion['id'] === (string) $value;
        });
    }

}
