<template>
	<div>
		<form @submit.prevent="storeInventario" autocomplete="off">
            <div class="form-row">
                <div class="col-sm-12 col-md-5 col-lg-5">
                    <div class="form-group">
                        <label>Útil escolar</label>
                        <select class="form-control" required
                        	:class="{'is-invalid': errors.exists('implemento_id')}">
                            <option :value="inventario.implemento_id" v-text="inventario.nomb_util">
                            </option>
                        </select>
	                	<div class="invalid-feedback" v-text="errors.get('implemento_id')"></div>
                    </div>
                </div>
                <div class="form-group col-md-3 col-lg-3">
			    	<label>Cantidad</label>
			   		<input type="number" v-model="inventario.cant_util" class="form-control" required
			   			autofocus :class="{'is-invalid': errors.exists('cant_util')}">
	                <div class="invalid-feedback" v-text="errors.get('cant_util')"></div>
			  	</div>
			  	<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group my-4 d-flex justify-content-sm-center justify-content-md-start">
						<button type="button" class="btn btn-secondary" @click.prevent="limpiarInventario">
                            Limpiar
                        </button>
                        <button type="submit" class="btn btn-primary" :disabled="waiting">
                            Actualizar
                        </button>
						<span class="mx-3" v-show="waiting">
							<i class="fas fa-sync fa-spin fa-2x align-middle"></i>
						</span>
					</div>
				</div>
            </div>
        </form>

	</div>
</template>

<script>
  	import {Mixins} from './mixins/mixins';

	export default {
		name: 'Edit',
		mixins: [Mixins],
	    props: {
	      	inventario: {
	      		type: Object,
	      		required: true,
	      	},
	    },
  		methods: {
			storeInventario () {
				this.$emit('saveInventario');
			},
		    limpiarInventario () {
			    this.$emit('clearInventario');
		    },
	  	},
	}
</script>