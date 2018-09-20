<?php

namespace App\Facades;

class Documento
{
    /**
     * Devuelve los tipos de documentos.
     *
     * @return array
     */
    public function tipos()
    {
    	return [
    		'R.C.', 'T.I.', 'C.C.',
    	];
    }

    /**
     * Devuelve los tipos de documentos para acudiente.
     *
     * @return array
     */
    public function acudiente()
    {
    	return [
    		'T.I.', 'C.C.',
    	];
    }

      /**
     * Devuelve los tipos de documentos para alumno.
     *
     * @return array
     */
    public function alumno()
    {
        return [
            'T.I.', 'R.C.',
        ];
    }

}
