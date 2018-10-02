<template>
	<div>
		<inventario-edit @saveInventario="updateInventario" @clearInventario="limpiarInventario"
			:waiting="waiting" :errors="errors" :inventario="inventario" v-if="canEdit && editing">
		</inventario-edit>

		<inventario-create ref="createInventario" @saveInventario="storeInventario"
			@clearInventario="limpiarInventario" :estudiante-id="estudianteId" :implementos="implementos"
			:waiting="waiting" :errors="errors" v-if="canCreate && !editing">
		</inventario-create>

        <div class="row clearfix" v-if="canIndex">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div v-if="loading">
                    <div class="mx-3 my-4 text-center">
						<i class="fas fa-sync fa-spin fa-3x"></i>
					</div>
                </div>
                <div v-else>
                    <div v-if="inventarios.length > 0">
                        <div class="table-responsive">
                            <table cellspacing="0" cellpadding="0" class="table table-striped table-hover pmd-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Cantidad</th>
                                        <th class="text-center text-nowrap">Opción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(inventario, index) in inventarios" :key="index">
                                        <td v-text="index + 1"></td>
                                        <td v-text="inventario.nomb_util"></td>
                                        <td v-text="inventario.pivot.cant_util"></td>
                                        <td class="text-center width-auto">
                                            <button type="button" @click.prevent="editInventario(inventario)"
                                                class="btn btn-sm btn-float" data-toggle="tooltip" title="Editar"
                                                v-if="canEdit">
                                                <i class="material-icons pmd-sm">edit</i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-float" disabled v-else>
                                                <i class="material-icons pmd-sm">edit</i>
                                            </button>
                                            <button type="button" @click.prevent="destroyInventario(inventario.id)"
                                                class="btn btn-sm btn-danger btn-float" data-toggle="tooltip"
                                                title="Eliminar" v-if="canDestroy">
                                                <i class="material-icons">delete</i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger btn-float" disabled v-else>
                                                <i class="material-icons">delete</i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <pagination :paginacion="pagination" @nextPage="changePage"></pagination>
                    </div>
                    <div v-else>
                        <div class="alert alert-info" role="alert">
							<i class="material-icons mr-1">info</i> No hay útiles escolares registrados.
						</div>
                    </div>
                </div>
            </div>
        </div>

	</div>
</template>

<script>
	import InventarioCreate from './Create.vue'
	import InventarioEdit from './Edit.vue'
    import {Paginacion} from './../mixins/paginacion';
    import Pagination from './../partials/Pagination.vue';
    import Errors from './../clases/errors';

	export default {
		name: 'Implement',
	    props: {
	      	estudianteId: {
		        type: String,
		        required: true,
	      	},
	      	implementos: {
		        type: Array,
		        required: true,
	      	},
	      	canIndex: {
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
	  	components: {
	    	InventarioCreate,
	    	InventarioEdit,
	    	Pagination,
	  	},
	    data() {
		    return {
		    	inventario: {
            		id: '',
            		nomb_util: '··· Seleccione ···',
            		cant_util: '',
			    	estudiante_id: '',
			    	implemento_id: '',
            	},
		    	inventarios: [],
		    	waiting: false,
		    	loading: false,
		    	creating: false,
		    	editing: false,
		    	errors: new Errors(),
		    }
		},
		mixins: [Paginacion],
		created () {
			this.getInventarios();
		},
  		methods: {
            getInventarios (page)
            {
                this.loading = true;

                axios.get(`/estudiantes/${this.estudianteId}/implementos?page=${page}`).then(response => {
                    this.inventarios = response.data.implementos.data;
                    this.pagination = response.data.pagination;
                    this.loading = false;
                })
                .catch(error => {
                    this.loading = false;
                    this.showSweetAlert(error.response.data.message, 'error');
                });
            },
            changePage (page)
            {
                this.pagination.current_page = page;
                this.getInventarios(page);
            },
		    storeInventario (inventario) {
		        this.errors.clear();
		        this.waiting = true;

		        axios.post(`/estudiantes/${this.estudianteId}/implementos`, inventario).then(response => {
		          	this.waiting = false;
		          	this.getInventarios();
		          	this.$refs.createInventario.limpiarNuevo();
		          	this.showSweetAlert(response.data.message, 'success');
		        })
		        .catch(error => {
		          	this.waiting = false;
		          	if (error.response.data.errors) {
		            	this.errors.record(error.response.data);
		          	} else  {
		          		this.showSweetAlert(error.response.data.message, 'error');
		          	}
		        });
		    },
		    editInventario (inventario)
            {
            	this.inventario = {
            		id: inventario.pivot.id,
            		nomb_util: inventario.nomb_util,
            		cant_util: inventario.pivot.cant_util,
			    	estudiante_id: inventario.pivot.estudiante_id,
			    	implemento_id: inventario.pivot.implemento_id,
            	}
            	this.editing = true;
            },
            updateInventario () {
            	this.errors.clear();
		        this.waiting = true;

		        axios.put(`/estudiantes/${this.estudianteId}/implementos/${this.inventario.implemento_id}`, this.inventario).then(response => {
		          	this.waiting = false;
		          	this.getInventarios();
		          	this.limpiarInventario();
		          	this.showSweetAlert(response.data.message, 'success');
		        })
		        .catch(error => {
		          	this.waiting = false;
		          	if (error.response.data.errors) {
		            	this.errors.record(error.response.data);
		          	} else  {
		          		this.showSweetAlert(error.response.data.message, 'error');
		          	}
		        });
            },
		    destroyInventario (id) {
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
						this.waiting = true;

				        axios.delete(`/estudiantes/${this.estudianteId}/implementos/${id}`).then(response => {
				          	this.waiting = false;
				          	this.getInventarios();
				          	this.showSweetAlert(response.data.message, 'success');
				        })
				        .catch(error => {
				          	this.waiting = false;
				          	this.showSweetAlert(error.response.data.message, 'error');
				        });
					}
				});
		    },
		    limpiarInventario () {
		    	this.inventario = {
            		id: '',
            		nomb_util: '··· Seleccione ···',
            		cant_util: '',
			    	estudiante_id: '',
			    	implemento_id: '',
            	};
            	this.editing = false;
            	this.errors.clear();
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
	}
</script>