<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb2">
                    <div class="col-12">
                        <h1>Productos</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <router-link class="btn btn-primary" :to="{ name: 'productos.create' }">Agregar</router-link>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-hover" v-if="productos.length > 0">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Código</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Decripción</th>
                                            <th scope="col">Stock mínimo</th>
                                            <th scope="col">Existencia</th>
                                            <th scope="col">Costo</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="producto in productos">
                                            <th scope="row">{{ producto.id }}</th>
                                            <td>{{ producto.codigo }}</td>
                                            <td>{{ producto.nombre }}</td>
                                            <td>{{ producto.descripcion }}</td>
                                            <td>{{ producto.stock_minimo_viable }}</td>
                                            <td>{{ producto.existencia }}</td>
                                            <td>{{ producto.precio }}</td>
                                            <td>
                                                <router-link :to="{ name: 'productos.show', params: { id: producto.id } }">
                                                    Detalle
                                                </router-link>
                                                <router-link :to="{ name: 'productos.edit', params: { id: producto.id } }">
                                                    Modificar
                                                </router-link>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <blockquote class="quote-primary m-0" v-else>
                                    <h4>No hay registros</h4>
                                    Ningún producto ha sido registrado
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</template>

<script>
    export default {
        data() {
            return {
                productos: []
            }
        },
        mounted() {
            axios.get('/api/productos')
            .then(response => {
                this.productos = response.data
            })
            .catch(error => {
                console.log(error.response)
            })
        }
    }
</script>
