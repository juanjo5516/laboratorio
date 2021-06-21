<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb2">
                    <div class="col-12">
                        <h1>Presupuestos</h1>
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
                                <router-link class="btn btn-primary" :to="{ name: 'presupuestos.create' }">Agregar</router-link>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-hover" v-if="presupuestos.length > 0">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Período</th>
                                            <th scope="col">Monto total</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="presupuesto in presupuestos">
                                            <th scope="row">{{ presupuesto.id }}</th>
                                            <td>{{ presupuesto.periodo }}</td>
                                            <td>{{ Intl.NumberFormat("es-GT", { style: "currency", currency: "GTQ" }).format(presupuesto.monto) }}</td>
                                            <td>
                                                <router-link :to="{ name: 'presupuestos.show', params: { id: presupuesto.id } }">
                                                    Detalle
                                                </router-link>
                                                <router-link :to="{ name: 'presupuestos.edit', params: { id: presupuesto.id } }">
                                                    Modificar
                                                </router-link>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <blockquote class="quote-primary m-0" v-else>
                                    <h4>No hay registros</h4>
                                    Ningún presupuesto ha sido registrado
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
                presupuestos: []
            }
        },
        mounted() {
            axios.get('/api/presupuestos')
            .then(response => {
                this.presupuestos = response.data
            })
            .catch(error => {
                console.log(error.response)
            })
        }
    }
</script>
