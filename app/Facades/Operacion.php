<?php

namespace App\Facades;

class Operacion
{
    /**
     * Constantes
     *
     * @var constantes
     */
    const REGISTRADO = '0';
    const ACTUALIZADO = '1';
    const ELIMINADO = '2';
    const TODO = '3';

    /**
     * Devuelve la operación registrado.
     *
     * @return string
     */
    public function registrado()
    {
    	return self::REGISTRADO;
    }

    /**
     * Devuelve la operación actualizado.
     *
     * @return string
     */
    public function actualizado()
    {
        return self::ACTUALIZADO;
    }

    /**
     * Devuelve la operación eliminado.
     *
     * @return string
     */
    public function eliminado()
    {
        return self::ELIMINADO;
    }

    /**
     * Devuelve la operación todo.
     *
     * @return string
     */
    public function todo()
    {
        return self::TODO;
    }

    /**
     * Devuelve los valores de las operaciones.
     *
     * @return array
     */
    public function indexados()
    {
    	return [
    		self::REGISTRADO, self::ACTUALIZADO, self::ELIMINADO, self::TODO,
    	];
    }

    /**
     * Devuelve los valores de las operaciones con su etiqueta.
     *
     * @return array
     */
    public function asociativos()
    {
    	return [
            ['id' => self::TODO, 'texto' => 'Todo'],
            ['id' => self::REGISTRADO, 'texto' => 'Registrado'],
            ['id' => self::ACTUALIZADO, 'texto' => 'Actualizado'],
            ['id' => self::ELIMINADO, 'texto' => 'Eliminado'],
    	];
    }

    /**
     * Devuelve el nombre de la primera operación encontrada.
     *
     * @return array
     */
    public function find($value)
    {
        $operaciones = $this->asociativos();

        return array_first($operaciones, function ($operacion) use ($value) {
            return $operacion['id'] === (string) $value;
        });
    }

}
