<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb2">
                    <div class="col-12">
                        <h1>Materiales</h1>
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
                                <router-link class="btn btn-primary" :to="{ name: 'materiales.create' }">Agregar</router-link>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-hover" v-if="materiales.length > 0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Código</th>
                                            <th>Nombre</th>
                                            <th>Decripción</th>
                                            <th>Stock mínimo</th>
                                            <th>Existencia</th>
                                            <th>Precio</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="material in materiales">
                                            <td>{{ material.id }}</td>
                                            <td>{{ material.codigo }}</td>
                                            <td>{{ material.nombre }}</td>
                                            <td>{{ material.descripcion }}</td>
                                            <td>{{ material.stock_minimo_viable }}</td>
                                            <td>{{ material.existencia }}</td>
                                            <td>{{ material.precio }}</td>
                                            <td>
                                                <router-link :to="{ name: 'materiales.show', params: { id: material.id } }">
                                                    Detalle
                                                </router-link>
                                                <router-link :to="{ name: 'materiales.edit', params: { id: material.id } }">
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
                materiales: []
            }
        },
        mounted() {
            axios.get('/api/materiales')
            .then(response => {
                this.materiales = response.data
            })
            .catch(error => {
                console.log(error.response)
            })
        }
    }
</script>
