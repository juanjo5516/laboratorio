<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb2">
                    <div class="col-12">
                        <h1>Detalle de presupuesto</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <i class="fas fa-arrow-left fa-lg mb-3" role="button" title="Regresar" v-on:click="$router.go(-1)"></i>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <h3 class="profile-username text-center">
                                    {{ Intl.NumberFormat("es-GT", { style: "currency", currency: "GTQ" }).format(presupuesto.monto) }}
                                </h3>
                                <p class="text-muted text-center">
                                    Presupuesto {{ presupuesto.periodo }}
                                </p>
                                <router-link class="btn btn-outline-primary btn-block" :to="{ name: 'presupuestos.edit', params: { id: presupuesto.id } }">
                                    Modificar
                                </router-link>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <form v-on:submit.prevent="storeMonth" v-if="this.details.length < 12">
                                    <input type="hidden" v-model="detail.mes">
                                    <div class="form-group">
                                        <label for="monto">
                                            Ingrese el monto para el mes de 
                                            {{ months[details.length].description }}
                                        </label>
                                        <div class="input-group">
                                            <input class="form-control" id="monto" name="monto" type="text" required v-model="detail.monto">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit">
                                                    Agregar
                                                </button>
                                            </div>
                                        </div>
                                        <small id="montoHelpBlock" class="form-text text-muted">
                                            Saldo por ingresar: <b>{{ Intl.NumberFormat("es-GT", { style: "currency", currency: "GTQ" }).format(saldo) }}</b>
                                        </small>
                                    </div>
                                </form>
                                <table class="table table-striped table-sm" v-if="details.length > 0">
                                    <thead>
                                        <tr>
                                            <th scope="col" width="70%">Mes</th>
                                            <th scope="col">
                                                Monto <br>
                                                <span role="button" v-bind:class="{ 'badge badge-primary': !isEdit, 'badge badge-danger': isEdit}" v-on:click="toggleIsEdit">
                                                    {{ isEdit ? 'cancelar modificación' : 'modificar'}}
                                                </span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(detail, index) in details">
                                            <td scope="row">
                                                <span class="text-capitalize">
                                                    {{ months[index].description }}
                                                </span>
                                            </td>
                                            <td>
                                                <span v-if="isEdit">
                                                    <input class="form-control" type="number" step="0.01" v-bind:value="detail.monto" v-bind:data-index="index" v-on:blur="updateMonth">
                                                </span>
                                                <span v-else>
                                                    {{ Intl.NumberFormat("es-GT", { style: "currency", currency: "GTQ" }).format(detail.monto) }}
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th scope="row">
                                                <span class="text-uppercase">
                                                    Total registrado
                                                </span>
                                            </th>
                                            <th>
                                                {{ Intl.NumberFormat("es-GT", { style: "currency", currency: "GTQ" }).format(total_registrado) }}
                                            </th>
                                        </tr>
                                    </tfoot> 
                                </table>
                                <div class="alert alert-info text-lead text-monospace" v-else>
                                    <i class="fas fa-arrow-up fa-lg"></i>
                                    Por favor, agregue el detalle del presupuesto {{ presupuesto.periodo }}
                                    <i class="fas fa-arrow-up fa-lg"></i>
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
    import Swal from 'sweetalert2';
    import toastr from 'toastr';
    toastr.options.positionClass = 'toast-bottom-right'

    export default {
        data() {
            return {
                months: [
                { id: 1, description: 'enero'},
                { id: 2, description: 'febrero'},
                { id: 3, description: 'marzo'},
                { id: 4, description: 'abril'},
                { id: 5, description: 'mayo'},
                { id: 6, description: 'junio'},
                { id: 7, description: 'julio'},
                { id: 8, description: 'agosto'},
                { id: 9, description: 'septiembre'},
                { id: 10, description: 'octubre'},
                { id: 11, description: 'noviembre'},
                { id: 12, description: 'diciembre'}
                ],
                presupuesto: {},
                detail: {},
                details: [],
                isEdit: false

            }
        },
        computed: {
            saldo() {
                return this.presupuesto.monto - this.total_registrado
            },
            total_registrado() {
                return this.details.reduce( (accumulator, { monto }) => accumulator + parseFloat(monto), 0)
            }
        },
        mounted() {
            Promise.all([
                axios.get(`/api/presupuestos/${ this.$route.params.id }`),
                axios.get(`/api/presupuestos/${ this.$route.params.id }/mes`)
                ])
            .then(response => {
                this.presupuesto = response[0].data
                this.details = response[1].data
            })
            .catch(error => {
                console.log(error.response)
            })
        },
        methods: {
            storeMonth(){
                if(this.detail.monto <= this.saldo) {
                    this.detail.mes = this.months[this.details.length].id
                    axios.post(`/api/presupuestos/${ this.presupuesto.id }/mes`, this.detail)
                    .then(response => {
                        this.details.push(response.data)
                    })
                    .catch(error => {

                    })
                } else {
                    Swal.fire('Error al registrar', `El monto ingresado para el mes de ${ this.months[this.details.length].description } no debe ser mayor al saldo`, 'error')
                }
            },
            toggleIsEdit() {
                this.isEdit = !this.isEdit
            },
            updateMonth(event) {
                let detail = {
                    ...this.details[event.target.dataset.index],
                    monto: parseFloat(event.target.value)
                };

                if(this.details[event.target.dataset.index].monto == detail.monto) {}
                else if(detail.monto <= this.saldo) {
                    axios.put(`/api/presupuestos/${ this.presupuesto.id }/mes/${ detail.id }`, detail)
                    .then(response => {
                        this.details.splice(event.target.dataset.index, 1, detail)
                        toastr.success(`El monto de ${ this.months[event.target.dataset.index].description } fue actualizado`)
                    })
                    .catch(error => {

                    })
                } else {
                    toastr.error('Error al actualizar', `El monto ingresado para el mes de ${ this.months[event.target.dataset.index].description } no debe ser mayor al saldo`)
                }
            }
        }
    }
</script>
