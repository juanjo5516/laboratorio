<template>
	<div class="content-wrapper">
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-12">
						<h1>Catálogos</h1>
					</div>
				</div>
			</div>
		</div>
		<div class="content">
			<div class="container-fluid">
				<div class="row" v-if="lists.data.length > 0">
					<div class="col-12">
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col-3">
										<select class="custom-select" id="table" name="table" v-model="form.table" v-on:change="getList(1)">
											<option value="unidades">Unidades</option>
											<option value="categorias">Categorias</option>
											<option value="formas">Formas de pago</option>
											<option value="estados">Estados de compra</option>
											<option value="bancos">Bancos</option>
										</select>
									</div>
									<div class="col-2">
										<button class="btn btn-primary mb-3" v-on:click="create">
											<i class="fas fa-plus"></i>
											Agregar
										</button>
									</div>
									<div class="col-2">
										<select class="custom-select" id="per_page" v-model="per_page" v-on:change="getList(1)">
											<option value="5">5 registros</option>
											<option value="10">10 registros</option>
											<option value="25">25 registros</option>
											<option value="50">50 registros</option>
											<option value="100">100 registros</option>
											<option v-bind:value="lists.total">todos los registros</option>
										</select>
									</div>
									<div class="col">
										<input type="search" class="form-control" id="search" placeholder="Buscar" v-model="search">
									</div>
								</div>
								<div class="table-responsive mt-3">
									<table class="table table-hover table-bordered">
										<caption>
											Mostrando registros del {{ lists.from }} al {{ lists.to }} de un total de {{ lists.total }} registros 
											<nav aria-label="...">
												<ul class="pagination justify-content-center">
													<li class="page-item" v-bind:class="{'disabled': lists.current_page == 1}">
														<button class="page-link" tabindex="-1" aria-disabled="true" v-on:click.prevent="cambiarPagina(lists.current_page - 1)">
															Anterior
														</button>
													</li>
													<li class="page-item" v-for="page in pagesNumber" v-bind:class="{'active': page == isActived}">
														<a class="page-link" href="#" v-on:click.prevent="cambiarPagina(page)">
															{{page}}
														</a>
													</li>
													<li class="page-item" v-bind:class="{'disabled': lists.current_page == lists.last_page}">
														<a class="page-link" href="#" v-on:click.prevent="cambiarPagina(lists.current_page + 1)">
															Siguiente
														</a>
													</li>
												</ul>
											</nav>
										</caption>
										<thead>
											<tr>
												<th scope="col" width="10%">Id</th>
												<th scope="col">Nombre</th>
												<th width="8%">Acciones</th>
											</tr>
										</thead>
										<tbody>
											<tr v-for="(list, index) in filter">
												<th scope="row">{{ list.id }}</th>
												<td>{{ list.initials ? list.initials + ' -' : '' }} {{ list.name }}</td>
												<td>
													<i class="fas fa-edit fa-lg text-primary" role="button" title="Modificar" v-bind:data-index="index" v-bind:data-id="list.id" v-on:click="edit"></i>
													<i class="fas fa-trash fa-lg text-danger" role="button" v-bind:data-index="index" v-bind:data-id="list.id" v-on:click="del"></i>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row" v-else>
					<div class="col-12">
						<blockquote class="quote-info p-3 ml-0">
							<h4>Sin registros en la base de datos</h4>
						</blockquote>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-scrollable">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="staticBackdropLabel">{{ form.title }}</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form autocomplete="off" v-on:submit.prevent="submit">
						<div class="modal-body">
							<div class="form-group">
								<label for="name">Nombre</label>
								<textarea class="form-control" id="name" name="nombre" rows="4" v-model="form.name" v-validate="'required'"></textarea>
								<div class="invalid-feedback">{{ errors.first('nombre') }}</div>
							</div>
							<div class="form-group" v-if="form.table == 'sub_programas'">
								<label for="programa_id">Programa</label>
								<select class="form-control" id="programa_id" name="sub programa" type="text" v-model="form.programa_id" v-validate="'required'">
									<option value=""></option>
									<option v-bind:value="programa.id" v-for="programa in programas">{{ programa.label }}</option>
								</select>
								<div class="invalid-feedback">{{ errors.first('sub programa') }}</div>
							</div>
							<div>
								<small class="form-text text-danger" v-for="err in errors_server">
									{{ err }}
								</small>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary">
								{{ form.submitButtonText }}
							</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">
								<i class="fas fa-times"></i>
								Cerrar
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import es from 'vee-validate/dist/locale/es';
	import toastr from 'toastr';
	import VeeValidate, { Validator } from 'vee-validate';
	import Vue from 'vue';
	import Swal from 'sweetalert2';

	toastr.options.closeButton = true;
	toastr.options.showMethod = 'slideDown';
	toastr.options.hideMethod = 'fadeOut';
	toastr.options.positionClass = 'toast-bottom-right';

	Vue.use(VeeValidate, {
		classes: true,
		classNames: {
			valid: 'valid',
			invalid: 'is-invalid'
		}
	});

	Validator.localize('es', es);
	
	export default {
		data() {
			return {
				access_point: '/api',
				lists: { data: [] },
				form: {
					table: 'unidades',
					title: null,
					method: null,
					submitButtonText: null
				},
				errors_server: [],
				search: '',
				per_page: 10,
				offset: 3

			}
		},
		computed: {
			isActived: function() {
				return this.lists.current_page
			},
			pagesNumber: function() {
				if(!this.lists.to) {
					return []
				}
				let from = this.lists.current_page - this.offset
				if( from < 1) {
					from = 1
				}

				let to = from + (this.offset * 2)
				if(to >= this.lists.last_page) {
					to = this.lists.last_page
				}
				let pagesArray = []
				while(from <= to) {
					pagesArray.push(from)
					from++
				}
				return pagesArray
			},
			filter() {
				return this.lists.data.filter((list) => `
					${list.id} ${list.name}`.toLowerCase().includes(this.search.toLowerCase()))
			}
		},
		mounted() {
			this.getList(1);
		},
		methods: {
			getList(page) {
				axios.get(`${ this.access_point }/${ this.form.table }`, {
					params: {
						table: this.form.table,
						page: page,
						per_page:this.per_page
					}
				})
				.then(response => this.lists = response.data)
				.catch(error => {
					console.log(error.response)
				})
			},
			cambiarPagina(page) {
				if(this.lists.current_page != page) {
					this.lists.current_page = page
					this.getList(page)
				}
			},
			create() {
				this.errors_server = [];
				this.setAttributesForm({
					table: this.form.table,
					title: 'Crear ' + this.form.table,
					method: 'post',
					submitButtonText: 'Guardar'
				})
				$('#staticBackdrop').modal('show');
			},
			edit(event) {
				this.errors_server = [];
				this.setAttributesForm({					
					id: this.lists.data[event.target.dataset.index].id,
					name: this.lists.data[event.target.dataset.index].name,
					index: event.target.dataset.index,
					table: this.form.table,
					title: 'Modificar ' + this.form.table,
					method: 'put',
					submitButtonText: 'Actualizar'
				})
				if(this.form.table == 'sub_programas') {
					this.form.programa_id = this.lists.data[event.target.dataset.index].programa_id
				}
				$('#staticBackdrop').modal('show');
			},
			del(event) {
				Swal.fire({
					title: '¿Está seguro?',
					html: `Se eliminará el registro: <span class="font-weight-bold">${this.lists.data[event.target.dataset.index].name}</span>.<br><br>Esta acción no podrá ser revertida.`,
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Eliminar',
					cancelButtonText: 'No'
				}).then((result) => {
					if (result.isConfirmed) {
						axios.delete(`${this.access_point}/${this.form.table}/${event.target.dataset.id}`)
						.then(response => {
							this.lists.data.splice(event.target.dataset.index, 1)
							toastr.warning(`Se eliminó: ${this.lists.data[event.target.dataset.index].name}`)
							this.lists.total = this.lists.total - 1
						})
						.catch(error => {
							toastr.error(`Error ${error.response.status} - ${error.response.statusText ? error.response.statusText : ''}`)
						})
					}
				})
			},
			setAttributesForm(attributes) {
				this.form = attributes
			},
			submit() {
				this.validateForm()
				.then(isValid => {
					if(isValid) {
						this.sendForm()
					}
				})
			},
			validateForm() {
				return this.$validator.validate()
			},
			sendForm() {
				axios({
					method: this.form.method,
					url: `${this.access_point}/${ this.form.table }${ this.form.id ? '/' + this.form.id : '' }`,
					data: { name: this.form.name }

				})
				.then(response => {
					toastr.success(`Se registró correctamente : ${this.form.name}`)
					if(this.form.method == 'post') {
						this.lists.data.push({
							id: response.data.id,
							name: this.form.name,
						})
					} else {
						this.lists.data.splice(this.form.index,1, {
							id: this.form.id,
							id: this.form.id,
							name: this.form.name
						})
					}
					this.form.id = null
					this.form.name = null
					this.lists.total = this.lists.total + 1
					$('#staticBackdrop').modal('toggle');
				})
				.catch(error => {
					toastr.error(`Error ${error.response.status} - ${error.response.statusText ? error.response.statusText : ''}`)
					if (typeof error.response.data === 'object') {
						this.errors_server = _.flatten(_.toArray(error.response.data.errors));
					} else {
						Swal.fire({
							icon: 'error',
							title: `Error ${error.response.status} - ${error.response.statusText ? error.response.statusText : ''}`,
							text: `${error.response.data.message ? error.response.data.message : ''}`
						})
					}
					
				})
			}
		}
	}
</script>

<style>
@import "toastr";
</style>