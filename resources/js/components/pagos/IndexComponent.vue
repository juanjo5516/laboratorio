<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb2">
                    <div class="col-12">
                        <h1>Pagos realizados</h1>
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
                                <table class="table table-hover" v-if="pagos.length > 0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Beneficiario</th>
                                            <th scope="col">Monto</th>
                                            <th scope="col">Cuenta</th>
                                            <th scope="col">Banco</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="pago in pagos">
                                            <th scope="row">{{ pago.beneficiario }}</th>
                                            <td>{{ Intl.NumberFormat("es-GT", { style: "currency", currency: "GTQ" }).format(pago.monto) }}</td>
                                            <td>{{ pago.cuenta ? pago.cuenta : 'Pagado en efectivo' }}</td>
                                            <td>{{ pago.banco }}</td>
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
                pagos: []
            }
        },
        mounted() {
            axios.get('/api/pagos', {
                params: {
                    tipo: 'pagos'
                }
            })
            .then(response => {
                this.pagos = response.data
            })
            .catch(error => {
                console.log(error.response)
            })
        }
    }
</script>
