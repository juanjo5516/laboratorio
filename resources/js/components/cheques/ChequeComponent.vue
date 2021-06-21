<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb2">
                    <div class="col-12">
                        <h1>Imprimir cheque</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <router-link :to="{ name: 'cheques.index' }">
                    <i class="fas fa-arrow-left fa-lg mb-3" title="Ir a los  cheques"></i>
                </router-link>
                <div class="row">
                    <div class="col-md-9">
                        <div class="card border">
                            <div class="card-header">
                                <div class="card-title">Cheque número {{ pago.id }}</div>
                                <div class="card-tools">
                                    <a href="#" v-on:click="imprimir">Imprimir</a>
                                </div>
                            </div>
                            <div class="card-body" id="impresion">
                                <table width="100%">
                                    <thead>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Guatemala, {{ pago.created_at }}</td>
                                            <td>Q. {{ pago.monto }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" height="75">{{ pago.beneficiario }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">{{ pago.letras }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import numeroALetras from '../../utils/numeroALetras.js';

    export default {
        data() {
            return {
                pago: {},
            }
        },
        mounted() {
            axios.get('/api/pagos/' + this.$route.params.id)
            .then(response => {
                this.pago = response.data
                this.pago.letras = numeroALetras(this.pago.monto, {
                    plural: 'QUETZALES',
                    singular: 'QUETZAL',
                    centPlural: 'CENTAVOS',
                    centSingular: 'CENTAVO'
                });
            })
            .catch(error => {
                console.log(error.response)
            })
        },
        methods: {
            imprimir() {
                let printContents = document.getElementById('impresion').innerHTML;
                let w = window.open();
                w.document.write(printContents);
                w.document.close(); // necessary for IE >= 10
                w.focus(); // necessary for IE >= 10
                w.print();
                w.close();
                return true;
            }
        }
    }
</script>
