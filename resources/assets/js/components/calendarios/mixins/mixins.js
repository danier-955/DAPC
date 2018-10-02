export const Mixins = {
	props: {
    jornadas: {
      type: Object,
      required: true,
    },
  	errors: {
      required: true,
  	},
  	loading: {
      type: Boolean,
      required: false,
      default: false,
  	},
	},
};