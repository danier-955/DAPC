export const Mixins = {
	props: {
    jornadas: {
      type: Object,
      required: true,
    },
  	errors: {
      type: Object,
      required: false,
      default: false,
  	},
  	loading: {
      type: Boolean,
      required: false,
      default: false,
  	},
	},
	computed: {
  	messagesTitulo ()
  	{
    	return typeof(this.errors.titu_cale) !== 'undefined' && this.errors.titu_cale.length > 0;
  	},
  	messagesFechaInicial ()
  	{
    	return typeof(this.errors.fech_inic) !== 'undefined' && this.errors.fech_inic.length > 0;
  	},
  	messagesFechaFinal ()
  	{
    	return typeof(this.errors.fech_fina) !== 'undefined' && this.errors.fech_fina.length > 0;
  	},
    messagesJornada()
    {
      return typeof(this.errors.jorn_cale) !== 'undefined' && this.errors.jorn_cale.length > 0;
    },
  	messagesDescripcion ()
  	{
    	return typeof(this.errors.desc_cale) !== 'undefined' && this.errors.desc_cale.length > 0;
  	},
  	messagesFinalidad ()
  	{
    	return typeof(this.errors.fina_cale) !== 'undefined' && this.errors.fina_cale.length > 0;
  	},
	}
};