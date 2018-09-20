<template>
	<div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true" id="createCalendario">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">
						<i class="material-icons mr-1">event</i> Registrar calendario
					</h5>
				</div>
				<hr class="w-100 my-0">
				<form @submit.prevent="storeCalendario" autocomplete="off">
					<div class="modal-body">
						<div class="form-row">
							<div class="form-group col-md-9">
								<label>Titulo</label>
								<input type="text" v-model="nuevo.titu_cale" class="form-control" required autofocus :class="{'is-invalid': messagesTitulo}">
			                    <div class="invalid-feedback" v-if="messagesTitulo"
			                    	v-text="errors.titu_cale[0]"></div>
							</div>
							<div class="form-group col-md-3">
								<label>Jornada</label>
								<select v-model="nuevo.jorn_cale" class="selectpicker dropdown-dense show-tick selectbox form-control" required autofocus :class="{'is-invalid': messagesJornada}">
									<option v-for="(jornada, i) in jornadas.registrar" :key="i"
										:value="jornada.id" v-text="jornada.texto"></option>
								</select>
			                    <div class="invalid-feedback" v-if="messagesJornada"
			                    	v-text="errors.jorn_cale[0]"></div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-3">
								<label>Fecha inicial</label>
								<input type="text" id="fech_inic" class="today-datepicker form-control" required autofocus :class="{'is-invalid': messagesFechaInicial}">
			                    <div class="invalid-feedback" v-if="messagesFechaInicial"
			                    	v-text="errors.fech_inic[0]"></div>
							</div>
							<div class="form-group col-md-3">
								<label>Hora inicial</label>
								<input type="text" id="hora_inic" class="timepicker form-control" required autofocus :class="{'is-invalid': messagesFechaInicial}">
			                    <div class="invalid-feedback" v-if="messagesFechaInicial"
			                    	v-text="errors.fech_inic[0]"></div>
							</div>
							<div class="form-group col-md-3">
								<label>Fecha final</label>
								<input type="text" id="fech_fina" class="end-datepicker form-control" required autofocus :class="{'is-invalid': messagesFechaFinal}">
			                    <div class="invalid-feedback" v-if="messagesFechaFinal"
			                    	v-text="errors.fech_fina[0]"></div>
							</div>
							<div class="form-group col-md-3">
								<label>Hora final</label>
								<input type="text" id="hora_fina" class="timepicker form-control" required autofocus :class="{'is-invalid': messagesFechaFinal}">
			                    <div class="invalid-feedback" v-if="messagesFechaFinal"
			                    	v-text="errors.fech_fina[0]"></div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>Descripción</label>
								<textarea v-model="nuevo.desc_cale" class="form-control" rows="6" required autofocus :class="{'is-invalid': messagesDescripcion}"></textarea>
			                    <div class="invalid-feedback" v-if="messagesDescripcion"
			                    	v-text="errors.desc_cale[0]"></div>
							</div>
							<div class="form-group col-md-6">
								<label>Finalidad</label>
								<textarea v-model="nuevo.fina_cale" class="form-control" rows="6" required autofocus :class="{'is-invalid': messagesFinalidad}"></textarea>
			                    <div class="invalid-feedback" v-if="messagesFinalidad"
			                    	v-text="errors.fina_cale[0]"></div>
							</div>
						</div>
						<hr class="w-100 mt-2 mb-0">
					</div>
					<div class="modal-body pt-0 pb-3 text-center">
						<button type="button" class="btn" @click.prevent="closeModal">
							Cancelar
						</button>
						<button type="submit" class="btn btn-primary" :disabled="loading">Registrar</button>
						<span class="loading mx-3" v-show="loading">
							<i class="fas fa-sync fa-spin fa-2x align-middle"></i>
						</span>
					</div>
				</form>
			</div>
		</div>
	</div>
</template>

<script>
  	import {Mixins} from './mixins/mixins';

	export default {
		name: 'Create',
	    data() {
		    return {
			    nuevo: {
					titu_cale: '',
					fech_inic: '',
					fech_fina: '',
					jorn_cale: '',
					desc_cale: '',
					fina_cale: '',
			    },
		    }
		},
    	mixins: [Mixins],
		methods: {
			storeCalendario () {
				this.nuevo.fech_inic = `${document.querySelector('#fech_inic').value} ${document.querySelector('#hora_inic').value}`;
				this.nuevo.fech_fina = `${document.querySelector('#fech_fina').value} ${document.querySelector('#hora_fina').value}`;
				this.$emit('saveCalendario', this.nuevo);
			},
			openModal (date) {
				document.querySelector('#fech_inic').value = date.format();
				$('#fech_fina').bootstrapMaterialDatePicker('setMinDate', date);
		    	$('#createCalendario').modal('show');
		    },
			closeModal () {
		    	$('#createCalendario').modal('hide');
		    	this.limpiarCalendario();
		    },
		    limpiarCalendario () {
			    this.nuevo = {
					titu_cale: '',
					fech_inic: '',
					fech_fina: '',
					jorn_cale: '',
					desc_cale: '',
					fina_cale: '',
			    };
			    document.querySelector('#fech_inic').value = '';
			    document.querySelector('#hora_inic').value = '';
			    document.querySelector('#fech_fina').value = '';
			    document.querySelector('#hora_fina').value = '';
			    $('.selectpicker').selectpicker('refresh');
		    },
		},
	}
</script>