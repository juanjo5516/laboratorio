<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb2">
                    <div class="col-12">
                        <h1>Proveedores</h1>
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
                                <router-link class="btn btn-primary" :to="{ name: 'proveedores.create' }">Agregar</router-link>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-hover" v-if="proveedores.length > 0">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Nit</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Dirección</th>
                                            <th scope="col">Teléfono</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="material in proveedores">
                                            <th scope="row">{{ material.id }}</th>
                                            <td>{{ material.nit }}</td>
                                            <td>{{ material.nombre }}</td>
                                            <td>{{ material.direccion }}</td>
                                            <td>{{ material.telefono }}</td>
                                            <td>{{ material.email }}</td>
                                            <td>
                                                <router-link :to="{ name: 'proveedores.show', params: { id: material.id } }">
                                                    Detalle
                                                </router-link>
                                                <router-link :to="{ name: 'proveedores.edit', params: { id: material.id } }">
                                                    Modificar
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
                proveedores: []
            }
        },
        mounted() {
            axios.get('/api/proveedores')
            .then(response => {
                this.proveedores = response.data
            })
            .catch(error => {
                console.log(error.response)
            })
        }
    }
</script>
