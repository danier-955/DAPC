<template>
	<div>
		<form @submit.prevent="storeInventario" autocomplete="off">
            <div class="form-row">
                <div class="col-sm-12 col-md-5 col-lg-5">
                    <div class="form-group">
                        <label>Útil escolar</label>
                        <select class="selectpicker dropdown-dense show-tick selectbox form-control"
                        	id="implemento_id" name="implemento_id" data-live-search="true" data-live-search-placeholder="Búscar ..." required autofocus
                        	:class="{'is-invalid': errors.exists('implemento_id')}">
                            <option value="">··· Seleccione ···</option>
                            <option v-for="(implemento, index) in implementos" :key="index"
                            	:value="implemento.id" v-text="implemento.nomb_util">
                            </option>
                        </select>
	                	<div class="invalid-feedback" v-text="errors.get('implemento_id')"></div>
                    </div>
                </div>
                <div class="form-group col-md-3 col-lg-3">
			    	<label>Cantidad</label>
			   		<input type="number" v-model="nuevo.cant_util" class="form-control" required autofocus
                        :class="{'is-invalid': errors.exists('cant_util')}">
	                <div class="invalid-feedback" v-text="errors.get('cant_util')"></div>
			  	</div>
			  	<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group my-4 d-flex justify-content-sm-center justify-content-md-start">
						<button type="button" class="btn btn-secondary" @click.prevent="limpiarNuevo">
                            Limpiar
                        </button>
                        <button type="submit" class="btn btn-primary" :disabled="waiting">
                        	Registrar
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
		name: 'Create',
		mixins: [Mixins],
	    props: {
	      	estudianteId: {
		        type: String,
		        required: true,
	      	},
	      	implementos: {
		        type: Array,
		        required: true,
	      	},
	    },
	    data() {
		    return {
		    	nuevo: {
			    	cant_util: '',
			    	estudiante_id: '',
			    	implemento_id: '',
		    	},
		    }
		},
		mounted () {
			$('.selectpicker').selectpicker('refresh');
		},
  		methods: {
			storeInventario () {
				this.nuevo.estudiante_id = this.estudianteId;
				this.nuevo.implemento_id = document.querySelector('#implemento_id').value;
				this.$emit('saveInventario', this.nuevo);
			},
		    limpiarNuevo () {
			    this.nuevo = {
            		cant_util: '',
			    	estudiante_id: '',
			    	implemento_id: '',
		    	};
			    document.querySelector('#implemento_id').value = '';
			    $('.selectpicker').selectpicker('refresh');
			    this.$emit('clearInventario');
		    },
	  	},
	}
</script>