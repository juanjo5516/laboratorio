<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb2">
                    <div class="col-12">
                        <h1>Cheque emitidos</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body table-responsive">
                                <table class="table table-hover" v-if="cheques.length > 0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Beneficiario</th>
                                            <th scope="col">Monto</th>
                                            <th scope="col">Cuenta</th>
                                            <th scope="col">Banco</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="cheque in cheques">
                                            <th scope="row">{{ cheque.beneficiario }}</th>
                                            <td>{{ Intl.NumberFormat("es-GT", { style: "currency", currency: "GTQ" }).format(cheque.monto) }}</td>
                                            <td>{{ cheque.cuenta }}</td>
                                            <td>{{ cheque.banco }}</td>
                                            <td>
                                                <router-link :to="{ name: 'cheques.show', params: { id: cheque.id } }">
                                                    Mostrar
                                                </router-link>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <blockquote class="quote-primary m-0" v-else>
                                    <h4>No hay registros</h4>
                                    No hay cuentas por pagar
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
                cheques: []
            }
        },
        mounted() {
            axios.get('/api/pagos', {
                params: {
                    tipo: 'cheque'
                }
            })
            .then(response => {
                this.cheques = response.data
            })
            .catch(error => {
                console.log(error.response)
            })
        }
    }
</script>
