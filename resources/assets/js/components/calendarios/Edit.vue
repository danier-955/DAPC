<template>
	<div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true" id="showCalendario">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<div class="modal-header bg-light-2">
					<h5 class="modal-title">
						<i class="material-icons mr-1">event</i>
						<span v-if="showing">Ver calendario</span>
						<span v-if="editing">Editar calendario</span>
					</h5>
				</div>
				<hr class="w-100 my-0">
				<form @submit.prevent="updateCalendario" autocomplete="off" v-if="editing">
					<div class="modal-body">
						<div class="form-row">
							<div class="form-group col-md-12">
								<label>Titulo</label>
								<input type="text" v-model="seleccionado.titu_cale" class="form-control" required
									autofocus :class="{'is-invalid': errors.exists('titu_cale')}">
			                    <div class="invalid-feedback" v-text="errors.get('titu_cale')"></div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-3">
								<label>Fecha inicial</label>
								<input type="text" id="fech_comi" v-model="seleccionado.fech_inic" class="form-control" required autofocus :class="{'is-invalid': errors.exists('fech_inic')}">
			                    <div class="invalid-feedback" v-text="errors.get('fech_inic')"></div>
							</div>
							<div class="form-group col-md-3">
								<label>Hora inicial</label>
								<input type="text" id="hora_comi" v-model="seleccionado.hora_inic" class="form-control" required autofocus :class="{'is-invalid': errors.exists('fech_inic')}">
			                    <div class="invalid-feedback" v-text="errors.get('fech_inic')"></div>
							</div>
							<div class="form-group col-md-3">
								<label>Fecha final</label>
								<input type="text" id="fech_term" v-model="seleccionado.fech_fina" class="form-control" required autofocus :class="{'is-invalid': errors.exists('fech_fina')}">
			                    <div class="invalid-feedback" v-text="errors.get('fech_fina')"></div>
							</div>
							<div class="form-group col-md-3">
								<label>Hora final</label>
								<input type="text" id="hora_term" v-model="seleccionado.hora_fina" class="form-control" required autofocus :class="{'is-invalid': errors.exists('fech_fina')}">
			                    <div class="invalid-feedback" v-text="errors.get('fech_fina')"></div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-12">
								<label>Descripción</label>
								<textarea v-model="seleccionado.desc_cale" class="form-control" rows="4" required
									autofocus :class="{'is-invalid': errors.exists('desc_cale')}"></textarea>
			                    <div class="invalid-feedback" v-text="errors.get('desc_cale')"></div>
							</div>
						</div>
						<hr class="w-100 mt-2 mb-0">
					</div>
					<div class="modal-body pt-0 pb-3 text-center">
						<button type="button" class="btn" @click.prevent="closeModal">
							Cancelar
						</button>
						<button type="button" class="btn btn-danger" v-if="canDestroy" @click.prevent="destroyCalendario">
							Eliminar
						</button>
						<button type="submit" class="btn btn-primary" v-if="canEdit" :disabled="loading">
							Actualizar
						</button>
						<span class="loading mx-3" v-show="loading">
							<i class="fas fa-sync fa-spin fa-2x align-middle"></i>
						</span>
					</div>
				</form>
				<template v-if="showing">
					<div class="modal-body">
						<div class="form-row">
							<div class="form-group col-md-9">
								<p class="typography-subheading font-weight-bold my-1">
									Titulo
								</p>
								<p class="typography-subheading text-justify my-1"
									v-text="seleccionado.titu_cale"></p>
							</div>
							<div class="form-group col-md-3">
								<p class="typography-subheading font-weight-bold my-1">
									Jornada
								</p>
								<p class="typography-subheading my-1" v-text="jornada"></p>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-3">
								<p class="typography-subheading font-weight-bold my-1">
									Fecha &middot; hora inicial
								</p>
								<p class="typography-subheading my-1" v-html="fechaInicial"></p>
							</div>
							<div class="form-group col-md-3">
								<p class="typography-subheading font-weight-bold my-1">
									Fecha &middot; hora final
								</p>
								<p class="typography-subheading my-1" v-html="fechaFinal"></p>
							</div>
							<div class="form-group col-md-6">
								<p class="typography-subheading font-weight-bold my-1">
									Responsable
								</p>
								<p class="typography-subheading my-1" v-text="responsable"></p>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-12">
								<p class="typography-subheading font-weight-bold my-1">
									Descripción
								</p>
								<p class="typography-subheading text-justify my-1"
									v-html="descripcion"></p>
							</div>
						</div>
					</div>
					<hr class="w-100 my-0 py-0">
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" v-if="permitidoEditar"
							@click.prevent="editarCalendario">
							Editar
						</button>
						<button type="button" class="btn btn-dark" @click.prevent="closeModal">
							Ok
						</button>
					</div>
				</template>
			</div>
		</div>
	</div>
</template>

<script>
  	import {Mixins} from './mixins/mixins';

	export default {
		name: 'Edit',
	    props: {
	      	administrativoId: {
		        type: String,
		        required: true,
	      	},
	      	showing: {
		        type: Boolean,
		        required: false,
		        default: false,
	      	},
		    editing: {
		        type: Boolean,
		        required: false,
		        default: false,
	      	},
		    isAdmin: {
		        type: Boolean,
		        required: true,
	      	},
	      	canEdit: {
		        type: Boolean,
		        required: false,
		        default: false,
	      	},
	      	canDestroy: {
		        type: Boolean,
		        required: false,
		        default: false,
	      	},
	      	seleccionado: {
	      		type: Object,
	      		required: true,
	      	}
	    },
    	mixins: [Mixins],
		methods: {
			addListeners () {
				let vm = this;
				$(document).ready(function()
		        {
		          	$('#fech_comi').change(function (e) {
		            	e.preventDefault();
		            	vm.$emit('changeDates', 'fech_inic', $('#fech_comi').val());
		          	});
		          	$('#hora_comi').change(function (e) {
		            	e.preventDefault();
		            	vm.$emit('changeDates', 'hora_inic', $('#hora_comi').val());
		          	});
		          	$('#fech_term').change(function (e) {
		            	e.preventDefault();
		            	vm.$emit('changeDates', 'fech_fina', $('#fech_term').val());
		          	});
		          	$('#hora_term').change(function (e) {
		            	e.preventDefault();
		            	vm.$emit('changeDates', 'hora_fina', $('#hora_term').val());
		          	});
		        });
			},
			setDatetimepicker () {
				let vm = this;
				$(document).ready(function()
				{
					/**
				     * Opciones datepicker bootstrapMaterialDatePicker
				     */
				    let bootstrapMaterialDatePickerOptions = {
				        lang : 'es',
				        weekStart : 1,
				        cancelText : 'CANCELAR',
				        clearButton: true,
				        clearText : 'LIMPIAR',
				    };

				    /**
				     * Datepicker fecha inicio
				     */
				    $('#fech_comi').bootstrapMaterialDatePicker({
				        format: 'YYYY-MM-DD',
				        minDate : new Date(),
				        time: false,
        				...bootstrapMaterialDatePickerOptions,
				    }).on('change', function(e, date)
				    {
				        e.preventDefault();
				        $('#fech_term').bootstrapMaterialDatePicker('setMinDate', date);
				    });

				    /**
				     * Datepicker fecha final
				     */
				    $('#fech_term').bootstrapMaterialDatePicker({
				        format: 'YYYY-MM-DD',
				        time: false,
        				...bootstrapMaterialDatePickerOptions,
				    });

					$('#fech_term').bootstrapMaterialDatePicker('setMinDate', vm.seleccionado.fech_inic);

				    /**
					 * Timepicker
					 */
					$('#hora_comi, #hora_term').bootstrapMaterialDatePicker({
				        format: 'hh:mm a',
				        shortTime: true,
				        date: false,
				        time: true,
				        monthPicker: false,
				        year: false,
        				...bootstrapMaterialDatePickerOptions,
				    });
				});
			},
		    editarCalendario () {
		    	this.$emit('switchVisibility', 'showing', false);
		    	this.$emit('switchVisibility', 'editing', true);
		    	this.setDatetimepicker();
    			this.addListeners();
		    },
		    updateCalendario () {
				this.$emit('saveCalendario', {
					id: this.seleccionado.id,
					titu_cale: this.seleccionado.titu_cale,
					fech_inic: `${this.seleccionado.fech_inic} ${this.seleccionado.hora_inic}`,
					fech_fina: `${this.seleccionado.fech_fina} ${this.seleccionado.hora_fina}`,
					jorn_cale: this.seleccionado.jorn_cale,
					desc_cale: this.seleccionado.desc_cale,
				});
		    },
			destroyCalendario () {
				this.$emit('deleteCalendario', this.seleccionado.id);
			},
			openModal () {
		    	$('#showCalendario').modal('show');
		    },
			closeModal () {
				$('#showCalendario').modal('hide');
		    	this.$emit('clearCalendario');
		    },
		},
		computed: {
			permitidoEditar () {
				return this.canEdit && ((this.isAdmin && this.jornadas.autenticado === this.seleccionado.jorn_cale) || (this.seleccionado.administrativo.id === this.administrativoId));
			},
			jornada () {
				let jornada = this.jornadas.ver.find((j) => this.seleccionado.jorn_cale === j.id);
				return jornada ? jornada.texto : '';
			},
		    fechaInicial () {
		    	return moment(this.seleccionado.fech_inic).format('DD/MM/YYYY') + ' &middot; ' + this.seleccionado.hora_inic
		    },
		    fechaFinal () {
		    	return moment(this.seleccionado.fech_fina).format('DD/MM/YYYY') + ' &middot; ' + this.seleccionado.hora_fina
		    },
		    responsable () {
		    	return `${this.seleccionado.administrativo.nomb_admi} ${this.seleccionado.administrativo.pape_admi} ${this.seleccionado.administrativo.sape_admi}`
		    },
		    descripcion ()  {
				return this.seleccionado.desc_cale.replace(new RegExp('\\n', 'g'), '<br>');
		    },
		},
	}
</script>