<?php

namespace App\Facades;

class Escala
{
    /**
     * Devuelve el escala bajo.
     *
     * @return string
     */
    public function bajo()
    {
    	return config('app.escala.bajo');
    }

    /**
     * Devuelve el escala basico.
     *
     * @return string
     */
    public function basico()
    {
        return config('app.escala.basico');
    }

    /**
     * Devuelve el escala alto.
     *
     * @return string
     */
    public function alto()
    {
        return config('app.escala.alto');
    }

    /**
     * Devuelve el escala superior.
     *
     * @return string
     */
    public function superior()
    {
        return config('app.escala.superior');
    }

    /**
     * Devuelve el nombre de la primera escala encontrada de acuerdo a la version corta o larga.
     *
     * @param real $value
     * @param boolean $version
     * @return array
     */
    public function find($value, $version)
    {
        if ($value <= $this->bajo()['max'])
        {
            return $version ? $this->bajo()['corta'] : $this->bajo()['larga'];
        }
        elseif ($value >= $this->basico()['min'] and $value <= $this->basico()['max'])
        {
            return $version ? $this->basico()['corta'] : $this->basico()['larga'];
        }
        elseif ($value >= $this->alto()['min'] and $value <= $this->alto()['max'])
        {
            return $version ? $this->alto()['corta'] : $this->alto()['larga'];
        }
        elseif ($value >= $this->superior()['min'])
        {
            return $version ? $this->superior()['corta'] : $this->superior()['larga'];
        }
    }

}
