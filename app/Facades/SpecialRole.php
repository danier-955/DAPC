<?php

namespace App\Facades;

class SpecialRole
{
    /**
     * Constantes
     *
     * @var constantes
     */
    const ALL_ACCESS = 'all-access';
    const NO_ACCESS = 'no-access';
    const NULLABLE = NULL;
    const ADMINISTRADOR = 'administrador';
    const COORDINADOR = 'coordinador';
    const SECRETARIA = 'secretaria';
    const DOCENTE = 'docente';
    const ESTUDIANTE = 'estudiante';
    const ACUDIENTE = 'acudiente';

    /**
     * Devuelve el acceso allAccess.
     *
     * @return string
     */
    public function allAccess()
    {
        return self::ALL_ACCESS;
    }

    /**
     * Devuelve el acceso noAccess.
     *
     * @return string
     */
    public function noAccess()
    {
        return self::NO_ACCESS;
    }

    /**
     * Devuelve el acceso nullable.
     *
     * @return nullable
     */
    public function nullable()
    {
        return self::NULLABLE;
    }

    /**
     * Devuelve el slug del rol administrador.
     *
     * @return string
     */
    public function administrador()
    {
        return self::ADMINISTRADOR;
    }

    /**
     * Devuelve el slug del rol coordinador.
     *
     * @return string
     */
    public function coordinador()
    {
        return self::COORDINADOR;
    }

    /**
     * Devuelve el slug del rol secretaria.
     *
     * @return string
     */
    public function secretaria()
    {
        return self::SECRETARIA;
    }

    /**
     * Devuelve el slug del rol docente.
     *
     * @return string
     */
    public function docente()
    {
        return self::DOCENTE;
    }

    /**
     * Devuelve el slug del rol estudiante.
     *
     * @return string
     */
    public function estudiante()
    {
        return self::ESTUDIANTE;
    }

    /**
     * Devuelve el slug del rol acudiente.
     *
     * @return string
     */
    public function acudiente()
    {
        return self::ACUDIENTE;
    }

    /**
     * Devuelve los roles principales.
     *
     * @return array
     */
    public function roles()
    {
        return collect([
            self::ADMINISTRADOR, self::COORDINADOR, self::SECRETARIA,
            self::DOCENTE, self::ESTUDIANTE, self::ACUDIENTE,
        ]);
    }

    /**
     * Devuelve los valores de los accesos.
     *
     * @return array
     */
    public function indexados()
    {
        return [
            $this->allAccess(), $this->noAccess(),
        ];
    }

    /**
     * Devuelve los valores de los accesos con su etiqueta.
     *
     * @return array
     */
    public function asociativos()
    {
        return [
            [ 'id' => $this->allAccess(), 'texto' => 'Acceso total permitido' ],
            [ 'id' => $this->noAccess(), 'texto' => 'Acceso total restringido' ],
            [ 'id' => $this->nullable(), 'texto' => 'Acceso mediante permisos' ],
        ];
    }

    /**
     * Devuelve los valores de los accesos con su etiqueta.
     *
     * @return array
     */
    public function createAsociativos()
    {
        return [
            [ 'id' => $this->allAccess(), 'texto' => 'Acceso total restringido' ],
            [ 'id' => $this->nullable(), 'texto' => 'Acceso mediante permisos' ],
        ];
    }

    /**
     * Devuelve el nombre del primer acceso encontrado.
     *
     * @return array
     */
    public function find($value)
    {
        $accesos = $this->asociativos();

        return array_first($accesos, function ($acceso) use ($value) {
            return $acceso['id'] === $value;
        });
    }

    /**
     * Devuelve el color del acceso.
     *
     * @return array
     */
    public function getColor($value)
    {
        return ($this->noAccess() === $value) ? 'bg-danger text-white' : 'bg-success text-white';
    }

}
