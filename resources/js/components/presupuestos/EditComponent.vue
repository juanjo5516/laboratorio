<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb2">
                    <div class="col-12">
                        <h1 class="text-center">Modificar presupuesto</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body p-5">
                                <i class="fas fa-arrow-left fa-lg mb-3" role="button" title="Regresar" v-on:click="$router.go(-1)"></i>
                                <form autocomplete="off" id="formulario" v-on:submit.prevent="submit">
                                    <div class="form-group">
                                        <label for="periodo">Año</label>
                                        <input autofocus class="form-control" id="periodo" name="periodo" type="number" step="1" v-model="presupuesto.periodo" v-validate="'required'">
                                        <small id="emailHelp" class="form-text text-muted">
                                            Período del presupuesto
                                        </small>
                                        <div class="invalid-feedback">
                                            {{ errors.first('periodo') }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="monto">Monto total</label>
                                        <input class="form-control" id="monto" name="monto" type="number" step="0.01" v-model="presupuesto.monto" v-validate="'required'">
                                        <div class="invalid-feedback">
                                            {{ errors.first('monto') }}
                                        </div>
                                    </div>
                                    <blockquote class="quote-danger ml-0" v-show="errors_server.length > 0">
                                        <h4>
                                            El formulario tiene los siguientes errores
                                        </h4>
                                        <ul>
                                            <li v-for="error in errors_server">
                                                {{ error }}
                                            </li>
                                        </ul>
                                    </blockquote>
                                    <button class="btn btn-primary btn-block" type="submit">
                                        Actualizar
                                    </button>
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
    import es from 'vee-validate/dist/locale/es';
    import VeeValidate, { Validator } from 'vee-validate';
    import Vue from 'vue';
    import Swal from 'sweetalert2';

    Vue.use(VeeValidate, {
        classes: true,
        classNames: {
            valid: 'valid',
            invalid: 'is-invalid'
        }
    });

    Validator.localize('es', es);

    export default {
        data() {
            return {
                presupuesto: { },
                errors_server: []
            }
        },
        mounted() {
            axios.get('/api/presupuestos/' + this.$route.params.id)
            .then(response => {
                this.presupuesto = response.data
            })
            .catch(error => {
                console.log(errors.response)
            })
        },
        methods: {
            submit() {
                this.$validator.validate().then(isValid => {
                    if(isValid) {
                        axios.put('/api/presupuestos/' + this.$route.params.id, this.presupuesto)
                        .then(response => {
                            Swal.fire('Actualización exitosa', 'El presupuesto fue actualizado en la base de datos', 'success')
                        })
                        .catch(error => {
                            console.log(error.response)
                        })
                    }
                })
            }
        }
    }
</script>
