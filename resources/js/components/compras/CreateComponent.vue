<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb2">
                    <div class="col-12">
                        <h1>Registrar compra</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="invoice p-3 mb-3">
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="nit">Ingrese el nit del proveedor</label>
                                        <input class="form-control" type="text" v-on:blur="search" v-model="proveedor.nit">
                                        <div class="text-danger mt-2" v-show="notFound">
                                            Este nit no existe
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row invoice-info mb-3" v-show="proveedor.id">
                                <div class="col-sm-4 invoice-col">
                                    Proveedor
                                    <address>
                                        <strong>
                                            {{ proveedor.nombre }}
                                        </strong>
                                    </address>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                    Dirección
                                    <address>
                                        <strong>
                                            {{ proveedor.direccion }}
                                        </strong>
                                    </address>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                    Contacto
                                    <address>
                                        <strong>
                                            {{ proveedor.telefono }}
                                        </strong>
                                        <br>
                                        <strong>
                                            {{ proveedor.email }}
                                        </strong>
                                    </address>
                                </div>
                            </div>
                            <div class="row invoice-info mb-3" v-show="proveedor.id">
                                <div class="col-4">
                                    <label for="factura">Número de factura</label>
                                    <input class="form-control" type="text" v-model="compra.factura">
                                </div>
                                <div class="col-4">
                                    <label for="forma_pago_id">Forma de pago</label>
                                    <select class="custom-select" v-model="compra.forma_pago_id">
                                        <option value=""></option>
                                        <option value="1">Al contado</option>
                                        <option value="2">Al crédito</option>
                                    </select>
                                </div>
                                <div class="col-4" v-show="compra.forma_pago_id == 2">
                                    <label for="fecha_pago">Fecha de pago</label>
                                    <input class="form-control" type="date" v-model="compra.fecha_pago">
                                </div>
                                <div class="col-4 d-flex align-self-end">
                                    <a class="stretched-link" href="#" v-on:click="showModal">Agregar detalle</a>
                                </div>
                            </div>
                            <div class="row invoice-info" v-show="compra.productos.length > 0">
                                <div class="col-12">
                                    <table class="table table-striped projects">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th style="width: 15%">Imagen</th>
                                                <th>Producto</th>
                                                <th>Cantidad</th>
                                                <th>Precio</th>
                                                <th>Sub total</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(prod, index) in compra.productos">
                                                <td>
                                                    {{ prod.id }}
                                                </td>
                                                <td>
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item">
                                                            <img alt="product" class="img-fluid img-thumbnail" v-bind:src="prod.foto">
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    {{ prod.nombre }}
                                                </td>
                                                <td>
                                                    {{ prod.cantidad }}
                                                </td>
                                                <td>
                                                    {{ Intl.NumberFormat("es-GT", { style: "currency", currency: "GTQ" }).format(prod.precio) }}
                                                </td>
                                                <td>
                                                    {{ Intl.NumberFormat("es-GT", { style: "currency", currency: "GTQ" }).format(prod.cantidad * prod.precio) }}
                                                </td>
                                                <td>
                                                    <a class="text-danger" href="#" v-on:click="destroyItem" v-bind:data-index="index">
                                                        Eliminar
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row" v-show="total > 0">
                                <div class="col-12 text-center">
                                    <blockquote class="quote-danger ml-0 text-left" v-if="errors_server.length > 0">
                                        <h4>
                                            El formulario tiene los siguientes errores
                                        </h4>
                                        <ul>
                                            <li v-for="error in errors_server">
                                                {{ error }}
                                            </li>
                                        </ul>
                                    </blockquote>
                                    <h1>
                                        <small>
                                            Total factura: 
                                        </small>
                                        {{ Intl.NumberFormat("es-GT", { style: "currency", currency: "GTQ" }).format(total) }}
                                    </h1>
                                    <br>
                                    <button class="btn btn-primary" v-on:click="storeCompra">
                                        Guardar compra
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar detalle a la factura</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="material_id">Producto</label>
                            <select class="custom-select" v-model="material.index">
                                <option value=""></option>
                                <option v-bind:value="index" v-for="(material, index) in productos">
                                    {{ material.nombre }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cantidad">Cantidad</label>
                            <input class="form-control" type="number" step="1" v-model="material.cantidad">
                        </div>
                        <div class="form-group">
                            <label for="precio">Precio unitario</label>
                            <input class="form-control" type="number" step="0.01" v-model="material.precio">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" v-on:click="add">Agregar</button>
                        <a class="text-danger" href="#" data-dismiss="modal">Cerrar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Swal from 'sweetalert2';

    export default {
        data() {
            return {
                presupuesto: null,
                compra: {
                    productos: []
                },
                proveedor: {},
                notFound: false,
                productos: [],
                material: {},
                errors_server: []
            }
        },
        computed: {
            total() {
                let tot = this.compra.productos.reduce((acumulador, { cantidad, precio }) => acumulador += cantidad * precio, 0);
                this.compra.total = tot;
                return tot;
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            search() {
                axios.get('/api/proveedor/search', {
                    params: {
                        nit: this.proveedor.nit
                    }
                })
                .then(response => {
                    this.proveedor = response.data
                    this.notFound = false

                    if(this.productos.length == 0) {
                        this.getProducts()
                    }

                    this.compra.proveedor_id = this.proveedor.id
                    this.compra.proveedor = this.proveedor.nombre

                    if(this.presupuesto == null) {
                        this.getPresupuesto()
                    }
                })
                .catch(error => {
                    this.notFound = true
                    console.log(error.response)
                })
            },
            getProducts() {
                axios.get('/api/productos')
                .then(response => {
                    this.productos = response.data
                })
                .catch(error => {
                    console.log(error.response)
                })
            },
            getPresupuesto() {
                let month = new Date().getMonth() + 1;
                axios.get('/api/presupuestos/1/mes/' + month )
                .then(response => {
                    this.presupuesto = response.data
                })
                .catch(error => {
                    console.log(error.response)
                })
            },
            showModal() {
                $('#exampleModal').modal('show')
            },
            add() {
                this.compra.productos.push({
                    id: this.productos[this.material.index].id,
                    nombre: this.productos[this.material.index].nombre,
                    foto: this.productos[this.material.index].foto,
                    cantidad: this.material.cantidad,
                    precio: this.material.precio
                })

                this.productos.splice(this.material.index, 1)

                $('#exampleModal').modal('toggle')
            },
            destroyItem(event) {
                let material = this.compra.productos[event.target.dataset.index];
                this.compra.productos.splice(event.target.dataset.index, 1)
                this.productos.push(material);
            },
            storeCompra() {
                axios.post('/api/compras', this.compra)
                .then(response => {
                    Swal.fire('Registro exitoso', 'La compra fue guardada en la base de datos', 'success')
                    .then(result => this.$router.push({ name: 'compras.index' }));
                })
                .catch(error => {
                    if (typeof error.response.data === 'object') {
                        this.errors_server = _.flatten(_.toArray(error.response.data.errors));
                    } else {
                        this.errors_server = [
                        error.response.data.message ? error.response.data.message :
                        error.response.data
                        ];
                    }
                })
            }
        }
    }
</script>
