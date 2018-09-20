<?php

namespace App\Facades;

class TipoEstudiante
{
    /**
     * Constantes
     *
     * @var constantes
     */
    const PARVULO = '0';
    const JARDIN = '1';
    const TRANSICION = '2';
    const REGULAR = '3';

    /**
     * Devuelve el tipo de estudiante parvulo.
     *
     * @return string
     */
    public function parvulo()
    {
    	return self::PARVULO;
    }

    /**
     * Devuelve el tipo de estudiante jardin.
     *
     * @return string
     */
    public function jardin()
    {
        return self::JARDIN;
    }

    /**
     * Devuelve el tipo de estudiante transicion.
     *
     * @return string
     */
    public function transicion()
    {
        return self::TRANSICION;
    }

    /**
     * Devuelve el tipo de estudiante regular.
     *
     * @return string
     */
    public function regular()
    {
        return self::REGULAR;
    }

    /**
     * Devuelve los valores de los tipos de estudiantes.
     *
     * @return array
     */
    public function indexados()
    {
    	return [
    		self::PARVULO, self::JARDIN, self::TRANSICION, self::REGULAR,
    	];
    }

    /**
     * Devuelve los valores de los tipos de estudiantes con su etiqueta.
     *
     * @return array
     */
    public function asociativos()
    {
    	return [
            ['id' => self::PARVULO, 'texto' => 'Párvulos'],
            ['id' => self::JARDIN, 'texto' => 'Jardín'],
            ['id' => self::TRANSICION, 'texto' => 'Transición'],
            ['id' => self::REGULAR, 'texto' => 'Regular'],
    	];
    }

    /**
     * Devuelve el nombre del primer tipo de studiante encontrado.
     *
     * @return array
     */
    public function find($value)
    {
        $tipoEstudiantes = $this->asociativos();

        return array_first($tipoEstudiantes, function ($tipoEstudiante) use ($value) {
            return $tipoEstudiante['id'] === (string) $value;
        });
    }

}
