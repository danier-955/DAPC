<?php

namespace App\Facades;

class Jornada
{
    /**
     * Constantes
     *
     * @var constantes
     */
    const MANANA = '0';
    const TARDE = '1';
    const TODAS = '2';

    /**
     * Devuelve la jornada mañana.
     *
     * @return string
     */
    public function manana()
    {
    	return self::MANANA;
    }

    /**
     * Devuelve la jornada tarde.
     *
     * @return string
     */
    public function tarde()
    {
        return self::TARDE;
    }

    /**
     * Devuelve la jornada todas.
     *
     * @return string
     */
    public function todas()
    {
        return self::TODAS;
    }

    /**
     * Devuelve los valores de las jornadas.
     *
     * @return array
     */
    public function indexados()
    {
    	return [
    		self::MANANA, self::TARDE,
    	];
    }

    /**
     * Devuelve los valores de las jornadas con su etiqueta.
     *
     * @return array
     */
    public function asociativos()
    {
    	return [
            ['id' => self::MANANA, 'texto' => 'Mañana'],
            ['id' => self::TARDE, 'texto' => 'Tarde'],
    	];
    }

    /**
     * Devuelve los valores de las jornadas más todas (solo para administrativos).
     *
     * @return array
     */
    public function adminIndexados()
    {
        $indexados = $this->indexados();

        array_push($indexados, self::TODAS);

        return $indexados;
    }

    /**
     * Devuelve los valores de las jornadas más todas con su etiqueta (solo para administrativos).
     *
     * @return array
     */
    public function adminAsociativos()
    {
        $indexados = $this->asociativos();

        array_push($indexados, ['id' => self::TODAS, 'texto' => 'Todas']);

        return $indexados;
    }

    /**
     * Devuelve el nombre de la primera jornada encontrada.
     *
     * @return array
     */
    public function find($value)
    {
        $jornadas = $this->adminAsociativos();

        return array_first($jornadas, function ($jornada) use ($value) {
            return $jornada['id'] === (string) $value;
        });
    }

}
