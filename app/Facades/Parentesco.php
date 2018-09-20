<?php

namespace App\Facades;

class Parentesco
{
    /**
     * Constantes
     *
     * @var constantes
     */
    const ABUELO = '0';
    const ABUELA = '1';
    const PADRE = '2';
    const MADRE = '3';
    const TIO = '4';
    const TIA = '5';
    const HERMANA = '6';
    const HERMANO = '7';
    const PADRINO = '8';
    const MADRINA = '9';

    /**
     * Devuelve el parentesco abuelo.
     *
     * @return string
     */
    public function abuelo()
    {
    	return self::ABUELO;
    }

    /**
     * Devuelve el parentesco abuela.
     *
     * @return string
     */
    public function abuela()
    {
    	return self::ABUELA;
    }

    /**
     * Devuelve el parentesco padre.
     *
     * @return string
     */
    public function padre()
    {
        return self::PADRE;
    }

    /**
     * Devuelve el parentesco madre.
     *
     * @return string
     */
    public function madre()
    {
        return self::MADRE;
    }

    /**
     * Devuelve el parentesco tio.
     *
     * @return string
     */
    public function tio()
    {
        return self::TIO;
    }

    /**
     * Devuelve el parentesco tia.
     *
     * @return string
     */
    public function tia()
    {
        return self::TIA;
    }

    /**
     * Devuelve el parentesco hermana.
     *
     * @return string
     */
    public function hermana()
    {
        return self::HERMANA;
    }

    /**
     * Devuelve el parentesco hermano.
     *
     * @return string
     */
    public function hermano()
    {
        return self::HERMANO;
    }

    /**
     * Devuelve el parentesco padrino.
     *
     * @return string
     */
    public function padrino()
    {
        return self::PADRINO;
    }

    /**
     * Devuelve el parentesco madrina.
     *
     * @return string
     */
    public function madrina()
    {
        return self::MADRINA;
    }

    /**
     * Devuelve los valores de los parentescos.
     *
     * @return array
     */
    public function indexados()
    {
    	return [
    		self::ABUELO, self::ABUELA, self::PADRE,
			self::MADRE, self::TIO, self::TIA, 
			self::HERMANA, self::HERMANO, self::PADRINO,
            self::MADRINA,
    	];

    }

    /**
     * Devuelve los valores del parentesco con su etiqueta.
     *
     * @return array
     */
    public function asociativos()
    {
    	return [
    		['id' => self::ABUELO, 'texto' => 'Abuelo'],
            ['id' => self::ABUELA, 'texto' => 'Abuela'],
            ['id' => self::PADRE, 'texto' => 'Padre'],
            ['id' => self::MADRE, 'texto' => 'Madre'],
            ['id' => self::TIO, 'texto' => 'Tío'],
            ['id' => self::TIA, 'texto' => 'Tía'],
            ['id' => self::HERMANA, 'texto' => 'Hermana'],
            ['id' => self::HERMANO, 'texto' => 'Hermano'],
            ['id' => self::PADRINO, 'texto' => 'Padrino'],
            ['id' => self::MADRINA, 'texto' => 'Madrina'],
    	];
    }

    /**
     * Devuelve el nombre del primer parentesco encontrado.
     *
     * @return array
     */
    public function find($value)
    {
        $parentesco = $this->asociativos();

        return array_first($parentesco, function ($parentesco) use ($value) {
            return $parentesco['id'] === (string) $value;
        });
    }

}