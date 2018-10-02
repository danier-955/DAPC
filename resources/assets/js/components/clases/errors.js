export default class Errors {

	constructor ()
	{
   		this.errors = {};
 	}

 	/**
 	 * Asignar los errores
 	 */
	record (errors)
	{
		this.errors = errors.errors;
	}

	/**
	 * Limpiar los errores
	 */
	clear () {
		this.errors = {};
	}

	/**
	 * Verificar si existe un error
	 */
	exists (field)
	{
	 	return (this.errors[field]) ? true : false;
	}

	/**
	 * Obtener el valor del errror
	 */
	get (field)
	{
	 	if (this.errors[field])
	 	{
	  		return this.errors[field][0];
	 	}
	}
}