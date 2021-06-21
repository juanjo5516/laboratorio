<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb2">
                    <div class="col-12">
                        <h1>Generar cheque</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <i class="fas fa-arrow-left fa-lg mb-3" role="button" title="Regresar" v-on:click="$router.go(-1)"></i>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card card-primary">
                            <div class="card-body box-profile">
                                <p class="text-muted text-center">
                                    Proveedor
                                </p>
                                <h3 class="profile-username text-center">
                                    {{ cxc.proveedor }}
                                </h3>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>ID</b>
                                        <a class="float-right">
                                            {{ cxc.id }}
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Factura</b>
                                        <a class="float-right">
                                            {{ cxc.factura }}
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Total</b>
                                        <a class="float-right">
                                            {{ cxc.total }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card" v-if="pago.id == null">
                            <div class="card-body">
                                <h4>Datos del cheque</h4>
                                <form class="form-horizontal" v-on:submit.prevent="submit">
                                    <div class="form-group row">
                                        <label for="beneficiario" class="col-sm-2 col-form-label">Beneficiario</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="beneficiario" placeholder="Beneficiario" required v-model="pago.beneficiario">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="cuenta_id" class="col-sm-2 col-form-label">Cuenta bancaria</label>
                                        <div class="col-sm-10">
                                            <select class="custom-select" name="cuenta_id" id="cuenta_id" required v-model="pago.cuenta_id">
                                                <option value=""></option>
                                                <option v-bind:value="cuenta.id" v-for="cuenta in cuentas">
                                                    {{ cuenta.numero }} - {{ cuenta.banco }}
                                                </option>
                                            </select>
                                            <small id="cuenta_idHelp" class="form-text text-muted">
                                                <router-link :to="{ name: 'cuentas.create' }">
                                                    Crear una cuenta bancaria
                                                </router-link>
                                            </small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-success">
                                                Emitir cheque
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Swal from 'sweetalert2';

    export default {
        data() {
            return {
                cxc: {},
                pago: {
                },
                cuentas: []
            }
        },
        mounted() {
            Promise.all([
                axios.get('/api/cxc/' + this.$route.params.id),
                axios.get('/api/cuentas')
                ])
            .then(response => {
                this.cxc = response[0].data
                this.pago.beneficiario = this.cxc.proveedor
                this.pago.monto = this.cxc.total
                this.pago.compra_id = this.cxc.compra_id
                this.cuentas = response[1].data
            })
            .catch(error => {
                console.log(error.response)
            })
        },
        methods: {
            submit() {
                axios.post(`/api/cxc/${ this.$route.params.id }/cheque`, this.pago)
                .then(response => {
                    Swal.fire('Cheque generado', 'Se generó el cheque y también se actualizó la cuenta por pagar', 'success')
                    .then(result => {
                            this.$router.push({ name: 'cheques.show', params: {
                                id: response.data.id
                            }});
                        });

                })
                .catch(error => {
                    console.log(error.response)
                })
            }
        }
    }
</script>
