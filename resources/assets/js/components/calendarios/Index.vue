<template>
	<div>
		<full-calendar
			ref="calendar"
			:events="eventSources"
			@event-selected="eventSelected"
			@day-click="dayClick"
			:config="config">
		</full-calendar>

		<modal-create ref="createModal" @saveCalendario="storeCalendario" :errors="errors"
			:loading="loading" :jornadas="jornadas">
		</modal-create>

		<modal-edit ref="showModal" :jornadas="jornadas" @saveCalendario="updateCalendario"
			@deleteCalendario="destroyCalendario" @clearCalendario="limpiarCalendario"
			@switchVisibility="changeVisibility" @changeDates="updateDates" :errors="errors"
			:loading="loading" :showing="showing" :editing="editing" :seleccionado="seleccionado"
			:canDestroy="canDestroy" :canEdit="canEdit" :administrativoId="administrativoId"
			:isAdmin="isAdmin">
		</modal-edit>
	</div>
</template>

<script>
	import { FullCalendar } from 'vue-full-calendar'
	import ModalCreate from './Create.vue'
	import ModalEdit from './Edit.vue'
    import Errors from './../clases/errors'

	export default {
		name: 'Calendar',
	  	components: {
	    	FullCalendar,
	    	ModalCreate,
	    	ModalEdit,
	  	},
	    props: {
	      	administrativoId: {
		        type: String,
		        required: true,
	      	},
		    jornadas: {
		    	type: Object,
		        required: true,
		    },
		    isAdmin: {
		        type: Boolean,
		        required: true,
	      	},
	      	canCreate: {
		        type: Boolean,
		        required: true,
	      	},
	      	canEdit: {
		        type: Boolean,
		        required: true,
	      	},
	      	canDestroy: {
		        type: Boolean,
		        required: true,
	      	},
	    },
	    data() {
		    return {
		      	config: {
			        theme: 'bootstrap4',
					locale: 'es-us',
					header: {
						left: 'prev,next today',
						center: 'title',
						right: 'month,agendaWeek,agendaDay,listMonth'
					},
					buttonText: {
						today: 'Hoy',
					    month: 'Mes',
					    week: 'Semana',
					    day: 'Agenda',
					    list: 'Día'
					},
					allDayHtml: 'Todo<br/>el día',
					eventLimitText: 'más',
					noEventsMessage: 'No hay eventos para mostrar',
					buttonIcons: {
						prev: 'left-single-arrow',
						next: 'right-single-arrow',
					},
				    defaultDate: moment().format('YYYY-MM-DD'),
				    timezone: 'America/Bogota',
				    navLinks: true,
			      	editable: false,
			      	eventLimit: true,
			      	defaultView: 'month',
					loading: function (isLoading, view)
					{
						$(".cargando").show();
					},
			    },
			    events: [],
			    seleccionado: {
			    	id: '',
					titu_cale: '',
					fech_inic: '',
					hora_inic: '',
					fech_fina: '',
					hora_fina: '',
					jorn_cale: '',
					desc_cale: '',
					administrativo: {}
			    },
			    showing: false,
			    editing: false,
			    loading: false,
		    	errors: new Errors(),
		    }
		},
  		methods: {
		    refreshEvents() {
		    	this.$refs.calendar.$emit('refetch-events');
		    },
		    eventSelected(event, jsEvent, view)
		    {
		    	let fech_fina, hora_fina;

				if (event.end) {
					fech_fina = event.end.format('YYYY-MM-DD');
					hora_fina = event.end.format('hh:mm a');
				}
				else {
					fech_fina = event.start.format('YYYY-MM-DD');
					hora_fina = event.start.format('hh:mm a');
				}

				this.seleccionado = {
					id: event.idCalendario,
					titu_cale: event.title,
					fech_inic: event.start.format('YYYY-MM-DD'),
					hora_inic: event.start.format('hh:mm a'),
					fech_fina: fech_fina,
					hora_fina: hora_fina,
					jorn_cale: event.jorn_cale,
					desc_cale: event.desc_cale,
					administrativo: event.administrativo,
				};

				this.showing = true;
				this.$refs.showModal.openModal();
		    },
		    dayClick(date, jsEvent, view)
		    {
		    	if (this.canCreate)
		    	{
		    		if (date.format('YYYY-MM-DD') < moment().format('YYYY-MM-DD')) {
			        this.showSweetAlert('¡No es válido registrar un calendario desde una fecha pasada!', 'error');
				    } else {
						this.$refs.createModal.openModal(date);
				    }
		    	}
		    },
		    storeCalendario (nuevo) {
		        this.errors.clear();
		        this.loading = true;

		        axios.post('/calendarios', nuevo).then(response => {
		          	this.loading = false;
		          	this.refreshEvents();
		          	this.$refs.createModal.closeModal();
		          	this.$refs.createModal.limpiarCalendario();
		          	this.showSweetAlert(response.data.message, 'success');
		        })
		        .catch(error => {
		          	this.loading = false;
		          	if (error.response.data.errors) {
		            	this.errors.record(error.response.data);
		          	} else  {
		          		this.showSweetAlert(error.response.data.message, 'error');
		          	}
		        });
		    },
		    changeVisibility (property, value) {
				if (property === 'showing') {
					this.showing = value;
				}
				if (property === 'editing') {
					this.editing = value;
				}
			},
		    updateDates (property, value) {
		    	switch (property) {
		    		case 'fech_inic':
		    			this.seleccionado.fech_inic = value;
		    			break;
		    		case 'hora_inic':
		    			this.seleccionado.hora_inic = value;
		    			break;
		    		case 'fech_fina':
		    			this.seleccionado.fech_fina = value;
		    			break;
		    		case 'hora_fina':
		    			this.seleccionado.hora_fina = value;
		    			break;
		    	}
			},
		    updateCalendario (evento) {
		    	this.errors.clear();
		        this.loading = true;

		        axios.put(`/calendarios/${evento.id}`, evento).then(response => {
		    		this.loading = false;
		          	this.refreshEvents();
		          	this.$refs.showModal.closeModal();
		          	this.limpiarCalendario();
		          	this.showSweetAlert(response.data.message, 'success');
		          	this.showing = false;
    				this.editing = false;
		        })
		        .catch(error => {
		          	this.loading = false;
		          	if (error.response.data.errors) {
		            	this.errors.record(error.response.data);
		          	} else  {
		          		this.showSweetAlert(error.response.data.message, 'error');
		          	}
		        });
		    },
		    destroyCalendario (id) {
		    	swal({
					title: '¿Está seguro de eliminar?',
					text: "¡No podrás revertir esto!",
					type: 'warning',
					showCancelButton: true,
					cancelButtonText: 'Cancelar',
					confirmButtonText: 'Eliminar',
					buttonsStyling: false,
					confirmButtonClass: 'btn btn-danger',
					cancelButtonClass: 'btn'
				})
				.then((result) =>
				{
					if (result.value)
					{
						this.loading = true;

				        axios.delete(`/calendarios/${id}`).then(response => {
				          	this.loading = false;
				          	this.refreshEvents();
				          	this.$refs.showModal.closeModal();
				          	this.limpiarCalendario();
				          	this.showSweetAlert(response.data.message, 'success');
				          	this.showing = false;
		    				this.editing = false;
				        })
				        .catch(error => {
				          	this.loading = false;
				          	this.showSweetAlert(error.response.data.message, 'error');
				        });
					}
				});
		    },
		    limpiarCalendario () {
			    this.seleccionado = {
			    	id: '',
					titu_cale: '',
					fech_inic: '',
					hora_inic: '',
					fech_fina: '',
					hora_fina: '',
					jorn_cale: '',
					desc_cale: '',
					administrativo: {}
			    };
			    this.errors.clear();
			    this.showing = false;
			    this.editing = false;
			    this.loading = false;
		    },
		    showSweetAlert (message, type) {
		    	swal({
					title: message,
					type: type,
					toast: true,
					showConfirmButton: false,
					timer: 3000,
					position: 'top-right'
				});
		    },
	  	},
	  	computed: {
		    eventSources () {
		      	return {
	        		events (start, end, timezone, callback)
	        		{
	        			axios.get(`/calendarios/eventos?start=${start}&end=${end}&_=${Math.random()}`)
				            .then(response => {
				            	callback(response.data);
				            	$(".cargando").hide();
				            })
				            .catch(error => {
				              	swal({
									title: error.response.data.message,
									type: 'error',
									toast: true,
									showConfirmButton: false,
									timer: 3000,
									position: 'top-right'
								});
								$(".cargando").hide();
				            });
			        }
		        }
		    },
		},
	}
</script>

<style scoped>
	@import '~fullcalendar/dist/fullcalendar.css';
</style>