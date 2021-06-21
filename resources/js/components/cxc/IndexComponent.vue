<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb2">
                    <div class="col-12">
                        <h1>Cuentas por pagar</h1>
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
                                <table class="table table-hover" v-if="cxc.length > 0">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Proveedor</th>
                                            <th scope="col">Factura</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Plazo</th>
                                            <th scope="col">Fecha de pago</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="cx in cxc">
                                            <th scope="row">{{ cx.id }}</th>
                                            <td>{{ cx.proveedor }}</td>
                                            <td>{{ cx.factura }}</td>
                                            <td>{{ Intl.NumberFormat("es-GT", { style: "currency", currency: "GTQ" }).format(cx.total) }}</td>
                                            <td>{{ cx.plazo }}</td>
                                            <td>{{ cx.fecha_pago }}</td>
                                            <td>
                                                <router-link :to="{ name: 'cxc.cheque', params: { id: cx.id } }">
                                                    Emitir cheque
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
                cxc: []
            }
        },
        mounted() {
            axios.get('/api/cxc')
            .then(response => {
                this.cxc = response.data
            })
            .catch(error => {
                console.log(error.response)
            })
        }
    }
</script>
