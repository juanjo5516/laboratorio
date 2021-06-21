<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb2">
                    <div class="col-12">
                        <h1>Cuentas bancarias</h1>
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
                                <router-link class="btn btn-primary" :to="{ name: 'cuentas.create' }">Agregar</router-link>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-hover" v-if="cuentas.length > 0">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Número de cuenta</th>
                                            <th scope="col">Banco</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="cuenta in cuentas">
                                            <th scope="row">{{ cuenta.id }}</th>
                                            <td>{{ cuenta.numero }}</td>
                                            <td>{{ cuenta.banco }}</td>
                                            <td>
                                                <router-link :to="{ name: 'cuentas.show', params: { id: cuenta.id } }">
                                                    Detalle
                                                </router-link>
                                                <router-link :to="{ name: 'cuentas.edit', params: { id: cuenta.id } }">
                                                    Modificar
                                                </router-link>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <blockquote class="quote-primary m-0" v-else>
                                    <h4>No hay registros</h4>
                                    Ningún cuenta ha sido registrado
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
                cuentas: []
            }
        },
        mounted() {
            axios.get('/api/cuentas')
            .then(response => {
                this.cuentas = response.data
            })
            .catch(error => {
                console.log(error.response)
            })
        }
    }
</script>
