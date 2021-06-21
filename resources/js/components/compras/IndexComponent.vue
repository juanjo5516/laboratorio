<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb2">
                    <div class="col-12">
                        <h1>Compras</h1>
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
                                <router-link class="btn btn-primary" :to="{ name: 'compras.create' }">Agregar</router-link>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-hover" v-if="compras.length > 0">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Proveedor</th>
                                            <th scope="col">Factura</th>
                                            <th scope="col">Fecha factura</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Forma de pago</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="material in compras">
                                            <th scope="row">{{ material.id }}</th>
                                            <td>{{ material.proveedor }}</td>
                                            <td>{{ material.factura }}</td>
                                            <td>{{ material.created_at }}</td>
                                            <td>{{ Intl.NumberFormat("es-GT", { style: "currency", currency: "GTQ" }).format(material.total) }}</td>
                                            <td>{{ material.forma_pago }}</td>
                                            <td>
                                                <router-link :to="{ name: 'compras.show', params: { id: material.id } }">
                                                    Detalle
                                                </router-link>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <blockquote class="quote-primary m-0" v-else>
                                    <h4>No hay registros</h4>
                                    Ningún material ha sido registrado
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
                compras: []
            }
        },
        mounted() {
            axios.get('/api/compras')
            .then(response => {
                this.compras = response.data
            })
            .catch(error => {
                console.log(error.response)
            })
        }
    }
</script>
